<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    if (Auth::check()) {
      return redirect()->route('home.dashboard');
    } else {
      return view('home.welcome');
    }
  }
  public function indexDashboard()
  {
    return view('home.dashboard');
  }
  public function indexTransaction()
  {
    return view('home.transaction');
  }
  public function indexBudget()
  {
    return view('home.dashboard');
  }

  public function indexAccount()
  {
    return view('home.account');
  }
}
