<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Transaction;
use App\Models\Voucher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $vouchersCount = Voucher::all()->count();
        $usersCount = Voucher::all()->unique('username')->count();
        $todayTransactions = Transaction::whereDate('created_at', date("Y-m-d"))->get();
        return view('dashboard', [
            'vouchers_count' => $vouchersCount,
            'users_count' => $usersCount,
            'today_transactions' => $todayTransactions,
        ]);
    }
}



