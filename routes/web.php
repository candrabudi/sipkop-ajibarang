<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SavingController;
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

// Route for login process
Route::post('/process/login', [AuthController::class, 'login']);
Route::get('/', function () {
    return view('auth.login');
});

// Authentication routes
Auth::routes();

// Group routes that require user authentication
Route::middleware('auth')->group(function () {

    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Member management routes
    Route::prefix('member')->name('member.')->group(function () {
        Route::get('/list', [MemberController::class, 'index'])->name('list');
        Route::get('/create', [MemberController::class, 'create'])->name('create');
        Route::post('/save', [MemberController::class, 'store'])->name('save');
        Route::get('/edit/{id}', [MemberController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [MemberController::class, 'update'])->name('update');
    });

    // Saving management routes
    Route::prefix('saving')->name('savings.')->group(function () {
        Route::get('/list', [SavingController::class, 'index'])->name('list');
        Route::get('/create', [SavingController::class, 'create'])->name('create');
        Route::post('/save', [SavingController::class, 'store'])->name('save');
        Route::get('/history/{id}', [SavingController::class, 'History'])->name('history');
        Route::get('/deposit/{id}', [SavingController::class, 'deposit'])->name('deposit');
        Route::post('/deposit/{id}', [SavingController::class, 'depositStore'])->name('deposit.store');
    });

    // Loans management routes
    Route::prefix('loans')->name('loans.')->group(function () {
        Route::get('/list', [LoanController::class, 'index'])->name('list');
        Route::post('/save', [LoanController::class, 'createLoanAndSchedule'])->name('create');
        Route::get('/schedule/{a}', [LoanController::class, 'showInstallmentSchedule'])->name('showInstallmentSchedule');
        Route::post('/payment/{id}', [LoanController::class, 'payInstallment'])->name('payInstallment');
        Route::get('/deposit/{id}', [LoanController::class, 'deposit'])->name('deposit');
        Route::post('/deposit/{id}', [LoanController::class, 'depositStore'])->name('deposit.store');
    });

    // Withdrawal routes
    Route::prefix('withdraw')->name('savings.withdraw.')->group(function () {
        Route::get('/{id}', [WithdrawController::class, 'create'])->name('create');
        Route::post('/{id}', [WithdrawController::class, 'store'])->name('store');
    });
});
