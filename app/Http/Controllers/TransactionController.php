<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Voucher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', ['transactions' => $transactions]);
    }


    public function create()
    {
        $vouchers = Voucher::where('status', 0)->get();
        return view('transactions.create', ['vouchers' => $vouchers]);
    }

    /**
     * Store a new user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'voucher_code' => 'required',
        ]);

        $voucherId = $request->voucher_code;
        $voucher = Voucher::find($voucherId);
        $voucher->status = 1;
        $voucher->save();

        Transaction::create([
            'username' => $request->username,
            'voucher_code' => $voucher->code,
        ]);

        return to_route('transactions.index')->with('status', 'Transaction created successfully');
    }

    public function setRewardTransaction($username, $voucherCode, $rewardName, $ipAddress)
    {
        Transaction::create([
            'username' => $username,
            'voucher_code' => $voucherCode,
            'reward_name' => $rewardName,
            'ip_address' => $ipAddress,
        ]);
        return true;
    }
}



