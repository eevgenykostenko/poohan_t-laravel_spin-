<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CarouselController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [RewardController::class, 'home']);
Route::get('vouchers/run-spin', [VoucherController::class, 'runSpin'])->name('voucher.run-spin');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/edit-profile', [LoginController::class, 'showEditProfile'])
        ->name('edit-profile');

    Route::post('/edit-profile', [LoginController::class, 'updateProfile'])
        ->name('edit-profile');

    Route::get('/rewards', [RewardController::class, 'index'])
        ->name('rewards');

    Route::post('/rewards', [RewardController::class, 'storeRewards'])
        ->name('rewards');

    Route::resource('vouchers', VoucherController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('carousels', CarouselController::class);

    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings');

    Route::get('/settings/clear-db', [SettingsController::class, 'clearDb'])
        ->name('settings.clear_db');

});

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('login');

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');
