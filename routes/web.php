<?php

use App\Http\Controllers\AccountController;
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
    return redirect()->route('home.dashboard');
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
  // Route lien quan den HomeController
  Route::get('/budget', [HomeController::class, 'indexBudget'])->name('home.budget');
  Route::get('/account', [HomeController::class, 'indexAccount'])->name('home.account');
  Route::get('/transaction', [HomeController::class, 'indexTransaction'])->name('home.transaction');
  Route::get('/dashboard', [HomeController::class, 'indexDashboard'])->name('home.dashboard');

  // Route lien quan den AccountController
  Route::group(['prefix' => 'accounts/', 'as' => 'accounts.'], function () {
    Route::get('', [AccountController::class, 'index'])->name('index');
  });

  // Currency
  Route::get('/currency', [CurrencyController::class, 'show'])->name('currency');
  Route::post('/currency', [CurrencyController::class, 'store'])->name('currency.submit');
});
