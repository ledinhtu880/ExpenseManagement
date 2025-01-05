<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;

// Route cho màn hình Loading
Route::get('/loading', function () {
  return view('home.loading');
})->name('loading');

// Route cho Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
  if (Auth::check()) {
    return redirect()->route('budget.index');
  } else {
    return redirect()->route('loading');
  }
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'handleRegister']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('checkLogin')->group(function () {
  Route::get('/budget', [BudgetController::class, 'index'])->name("budget.index");
  Route::get('/account', [AccountController::class, 'index'])->name('account.index');
  Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

  // Currency
  Route::get('/currency', [CurrencyController::class, 'show'])->name('currency');
  Route::post('/currency', [CurrencyController::class, 'store'])->name('currency.submit');
});
