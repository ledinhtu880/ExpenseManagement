<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/budget/', [HomeController::class, 'indexBudget']);
Route::get('/budgets/', [HomeController::class, 'indexBudget']);
Route::get('/budgets/', [HomeController::class, 'indexBudget']);