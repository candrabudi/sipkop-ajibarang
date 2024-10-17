<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Savings;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function create($a)
    {
        $saving = Savings::join('members as m', 'm.id', '=', 'savings.member_id')
            ->select('m.name', 'm.phone', 'savings.*')
            ->first();
        return view('withdrawals.create', compact('saving'));
    }

    public function store(Request $request, $a)
    {
        $saving = Savings::where('id', $a)
            ->first();

        $saving->amount = $saving->amount - $request->withdrawal_amount;
        $saving->save();
        
        $store = new Withdrawal();
        $store->member_id = $saving->member_id;
        $store->savings_id = $saving->id;
        $store->withdrawal_amount = $request->withdrawal_amount;
        $store->save();

        return redirect()->route('savings.list');
    }
}
