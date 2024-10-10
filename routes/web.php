<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerPromotionController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentAccountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/process/login', [AuthController::class, 'login']);
Route::get('/', function () {
    return view('');
});

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
