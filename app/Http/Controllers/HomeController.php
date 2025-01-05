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
      return redirect()->route('indexBudget');
    } else {
      return view('home.welcome');
    }
  }
  public function indexBudget()
  {
    return view('budget.index');
  }
  public function indexAccount()
  {
    return view('account.index');
  }
  public function indexTransaction()
  {
    return view('transaction.index');
  }
  public function indexDashboard()
  {
    return view('dashboard.index');
  }
}
