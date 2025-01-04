<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/budget', [HomeController::class, 'indexBudget'])->name("indexBudget");
Route::get('/account', [HomeController::class, 'indexAccount'])->name('account.index');
Route::get('/transaction', [HomeController::class, 'indexTransaction'])->name('transaction.index');
Route::get('/dashboard', [HomeController::class, 'indexDashboard'])->name('dashboard.index');

