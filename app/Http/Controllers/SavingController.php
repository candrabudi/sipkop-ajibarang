<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Member;
use App\Models\Savings;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingController extends Controller
{
    public function index()
    {
        $savings = Savings::join('members as m', 'm.id', '=', 'savings.member_id')
            ->select('m.name', 'm.phone', 'savings.*')
            ->get();
        return view('savings.index', compact('savings'));
    }

    public function create()
    {
        $membersWithoutSavings = Member::leftJoin('savings', 'members.id', '=', 'savings.member_id')
            ->whereNull('savings.member_id')
            ->select('members.id','members.name', 'members.phone')
            ->get();

        return view('savings.create', compact('membersWithoutSavings'));
    }

    public function store(Request $request)
    {
        $store = new Savings();
        $store->member_id = $request->member_id;
        $store->amount = 0;
        $store->start_date = $request->start_date;
        $store->save();

        return redirect()->route('savings.list');
    }
    public function depositStore(Request $request, $a)
    {
        $saving = Savings::where('id', $a)
            ->first();

        $saving->amount = $saving->amount + $request->deposit_amount;
        $saving->save();
        
        $store = new Deposit();
        $store->member_id = $request->member_id;
        $store->savings_type_id = $a;
        $store->deposit_amount = $request->deposit_amount;
        $store->save();

        return redirect()->route('savings.list');
    }

    public function deposit($id)
    {
        $saving = Savings::join('members as m', 'm.id', '=', 'savings.member_id')
            ->select('m.name', 'm.phone', 'savings.*')
            ->first();
        return view('savings.edit', compact('saving'));
    }

    public function History($a)
    {
        // Mendapatkan data deposit dan menambahkan tipe 'deposit'
        $deposits = Deposit::where('savings_type_id', $a)
            ->select('deposit_amount as amount', 'created_at')
            ->get()
            ->map(function ($deposit) {
                $deposit->type = 'deposit'; // Menambahkan tipe deposit
                return $deposit;
            })
            ->toArray(); // Mengubah hasil ke dalam bentuk array
    
        // Mendapatkan data withdrawal dan menambahkan tipe 'withdrawal'
        $withdrawals = Withdrawal::where('savings_id', $a)
            ->select('withdrawal_amount as amount', 'created_at')
            ->get()
            ->map(function ($withdrawal) {
                $withdrawal->type = 'withdrawal'; // Menambahkan tipe withdrawal
                return $withdrawal;
            })
            ->toArray(); // Mengubah hasil ke dalam bentuk array
    
        // Menggabungkan keduanya
        $history = array_merge($deposits, $withdrawals);
    
        // Menyortir berdasarkan tanggal (created_at)
        usort($history, function ($a, $b) {
            return strtotime($a['created_at']) - strtotime($b['created_at']);
        });
    
        return view('savings.history', compact('history'));
    }
    
    
}
