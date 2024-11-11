<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Savings;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMember = Member::count();
        $totalDeposit = Deposit::sum('deposit_amount');
        $totalWithdraw = Withdrawal::sum('withdrawal_amount');
        $totalSaving = Savings::sum('amount');
        // Total loans by status
        $loanStatusData = Loan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status');

        // Total loans by loan type
        $loanTypeData = Loan::select('loan_type_id', DB::raw('count(*) as total'))
            ->groupBy('loan_type_id')
            ->get()
            ->pluck('total', 'loan_type_id');

        // Average interest rate by loan type
        $avgInterestRateData = Loan::select('loan_type_id', DB::raw('AVG(interest_rate) as avg_rate'))
            ->groupBy('loan_type_id')
            ->get()
            ->pluck('avg_rate', 'loan_type_id');

        // Total installments paid vs unpaid
        $installmentStatusData = Installment::select('is_paid', DB::raw('count(*) as total'))
            ->groupBy('is_paid')
            ->get()
            ->pluck('total', 'is_paid');

        return view('dashboard.index', compact(
            'loanStatusData', 
            'loanTypeData', 
            'avgInterestRateData', 
            'installmentStatusData',
            'totalMember',
            'totalWithdraw',
            'totalDeposit',
            'totalSaving'
        ));
    }
}
