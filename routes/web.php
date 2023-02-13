<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RewardController;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/edit-profile', [LoginController::class, 'showEditProfile'])
        ->name('edit-profile');

    Route::post('/edit-profile', [LoginController::class, 'updateProfile'])
        ->name('edit-profile');

    Route::get('/rewards', [RewardController::class, 'index'])
        ->name('rewards');

    Route::post('/rewards', [RewardController::class, 'storeRewards'])
        ->name('rewards');

});

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('login');

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');
