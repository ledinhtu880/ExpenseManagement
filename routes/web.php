<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'handleRegister']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('checkLogin')->group(function () {
  Route::get('/budget', [HomeController::class, 'indexBudget'])->name("indexBudget");
  Route::get('/account', [HomeController::class, 'indexAccount'])->name('account.index');
  Route::get('/transaction', [HomeController::class, 'indexTransaction'])->name('transaction.index');
  Route::get('/dashboard', [HomeController::class, 'indexDashboard'])->name('dashboard.index');
});
