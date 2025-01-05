<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HomeController;

// Route cho màn hình Loading
Route::get('/loading', function () {
  return view('home.loading');
})->name('loading');

// Route cho Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
  if (Auth::check()) {
    return redirect()->route('indexBudget');
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
  Route::get('/budget', [HomeController::class, 'indexBudget'])->name("indexBudget");
  Route::get('/account', [HomeController::class, 'indexAccount'])->name('account.index');
  Route::get('/transaction', [HomeController::class, 'indexTransaction'])->name('transaction.index');
  Route::get('/dashboard', [HomeController::class, 'indexDashboard'])->name('dashboard.index');

  // Currency
  Route::get('/currency', [CurrencyController::class, 'show'])->name('currency');
  Route::post('/currency', [CurrencyController::class, 'store'])->name('currency.submit');
});
