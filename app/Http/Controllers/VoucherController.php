<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        return view('vouchers.index', ['vouchers' => $vouchers]);
    }


    public function create()
    {
        return view('vouchers.create');
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
            'expire_datetime' => 'required',
        ]);

        $voucher = Voucher::create([
            'username' => $request->username,
            'expire_datetime' => $request->expire_datetime,
            'code' => Str::random(40),
        ]);

        return to_route('vouchers.index')->with('status', 'Voucher created successfully');
    }

    public function runSpin(Request $request)
    {
        $voucher = Voucher::where('code', $request->voucher_code)
            ->where('status', 0)->first();
        if (is_null($voucher))
            return 'invalid_voucher_code';

        $voucher->status = 1;
        $voucher->save();
        $rewardIndex = rand(1, Reward::all()->count());
        $reward = Reward::skip($rewardIndex - 1)->take(1)->first();
        $transactionController = new TransactionController();
        $transactionController->setRewardTransaction($voucher->username, $voucher->code, $reward->name, $request->ip());
        return $rewardIndex;
    }
}



