<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\Auth\Register2Controller;
use App\Http\Controllers\HomeController;

// Route cho màn hình Loading
Route::get('/loading', function () {
    return view('loading');
})->name('loading');

// Route cho Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route gốc (/) chuyển hướng đến màn hình loading
Route::get('/', function () {return redirect()->route('loading');});

// Route cho form đầu tiên: Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', function () {return redirect()->route('register2');})->name('register.submit');

Route::get('/register2', [Register2Controller::class, 'showRegister2Form'])->name('register2');
Route::post('/register2', function () {return redirect()->route('login');})->name('register2.submit');

// Route cho Login Form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/currency', [CurrencyController::class, 'show'])->name('currency');
Route::post('/currency', [CurrencyController::class, 'store'])->name('currency.submit');