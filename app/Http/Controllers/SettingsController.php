<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Voucher;
use App\Models\Transaction;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }


    public function clearDb()
    {
        Reward::trancate();
        Voucher::trancate();
        Transaction::trancate();
        return back()->with('status', 'Clear DB successfully');
    }
}



