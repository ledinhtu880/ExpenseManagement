<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\GroupType;
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
    $categories = Category::all();
    $groupTypes = GroupType::all();
    return view('home.dashboard', compact('user', 'categories', 'groupTypes'));
  }
  public function indexTransaction(Request $request)
  {
    $user = User::find(Auth::user()->user_id);
    $walletId = $request->input('wallet_id'); // Lấy wallet_id từ request

    $categories = Category::all();
    $groupTypes = GroupType::all();
    $currentMonthTransactions = $user->getCurrentMonthTransactions($walletId);
    $previousMonthTransactions = $user->getPreviousMonthTransactions($walletId);
    $currentMonthBalance = $user->getCurrentMonthBalance($walletId);
    $previousMonthBalance = $user->getPreviousMonthBalance($walletId);

    if ($request->ajax()) {
      return response()->json([
        'currentMonthTransactions' => $currentMonthTransactions,
        'previousMonthTransactions' => $previousMonthTransactions,
        'currentMonthBalance' => $currentMonthBalance,
        'previousMonthBalance' => $previousMonthBalance,
      ]);
    }

    return view('home.transaction', compact(
      'user',
      'currentMonthTransactions',
      'previousMonthTransactions',
      'currentMonthBalance',
      'previousMonthBalance',
      'walletId',
      'categories',
      'groupTypes'
    ));
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
