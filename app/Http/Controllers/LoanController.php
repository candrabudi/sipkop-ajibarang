<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\LoanType;
use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $members = Member::where('status', 1)
            ->get();

        $loanTypes = LoanType::all();
        $loans = Loan::all();
        return view('loans.index', compact('members', 'loanTypes', 'loans'));
    }
    public function showCreateForm()
    {
        $loanTypes = LoanType::all();
        return view('loan.create', compact('loanTypes'));
    }

    public function createLoanAndSchedule(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'loan_type_id' => 'required|exists:loan_types,id',
            'loan_amount' => 'required|numeric|min:0'
        ]);

        $loanType = LoanType::findOrFail($request->loan_type_id);

        $loanAmount = $request->loan_amount;
        $interestRate = $loanType->interest_rate;
        $duration = $loanType->duration;

        if ($loanAmount > $loanType->max_loan) {
            return response()->json(['error' => 'Loan amount exceeds maximum allowed for this loan type.'], 400);
        }

        $totalInterest = $loanAmount * ($interestRate / 100);
        $totalLoan = $loanAmount + $totalInterest; 

        $installmentAmount = $totalLoan / $duration;

        $no_trx = 'LN-' . time();
        $loan = Loan::create([
            'member_id' => $validated['member_id'],
            'loan_type_id' => $validated['loan_type_id'],
            'loan_amount' => $loanAmount,
            'remaining_loan' => $totalLoan,
            'interest_rate' => $interestRate,
            'loan_duration' => $duration,
            'installment_amount' => $installmentAmount,
            'status' => 'approved',
            'due_date' => Carbon::now()->addMonths($duration),
            'no_trx' => $no_trx
        ]);

        for ($i = 1; $i <= $duration; $i++) {
            $installmentDate = Carbon::now()->addMonths($i);
            $no_installment = 'IN-' . time() . '-' . $i;
            Installment::create([
                'loan_id' => $loan->id,
                'installment_number' => $i,
                'installment_amount' => $installmentAmount,
                'fine' => 0,
                'remaining_loan' => $totalLoan - ($installmentAmount * $i),
                'installment_date' => $installmentDate,
                'no_installment' => $no_installment
            ]);
        }

        return response()->json([
            'message' => 'Loan created and installment schedule generated successfully',
            'loan' => $loan,
            'installment_amount' => $installmentAmount,
            'schedule' => Installment::where('loan_id', $loan->id)->get(),
        ], 201);
    }

    public function showInstallmentSchedule($loanId)
    {
        $loan = Loan::findOrFail($loanId);
        $installments = Installment::where('loan_id', $loanId)->orderBy('installment_number')->get();
    
        return view('loans.schedule', compact('loan', 'installments'));
    }

    public function payInstallment($installmentId)
    {
        $installment = Installment::findOrFail($installmentId);
        $firstUnpaidInstallment = Installment::where('loan_id', $installment->loan_id)
            ->where('is_paid', false)
            ->orderBy('installment_number')
            ->first();

        if ($installment->id != $firstUnpaidInstallment->id) {
            return response()->json(['error' => 'You must pay the installments in order.'], 400);
        }

        $installment->is_paid = true;
        $installment->save();

        return response()->json(['message' => 'Installment paid successfully.']);
    }
}
