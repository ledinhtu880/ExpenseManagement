<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    $user = User::find(Auth::user()->user_id);
    return view('home.dashboard', compact('user'));
  }
  public function indexTransaction()
  {
    $user = User::find(Auth::user()->user_id);
    return view('home.transaction', compact('user'));
  }
  public function indexBudget()
  {
    $user = User::find(Auth::user()->user_id);
    return view('home.budget', compact('user'));
  }
  public function indexAccount()
  {
    $user = User::find(Auth::user()->user_id);
    return view('home.account', compact('user'));
  }
}
