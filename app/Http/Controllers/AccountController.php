<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Exception;

class AccountController extends Controller
{
  public function index()
  {
    return view('account.index');
  }
  public function edit()
  {
    $user = User::find(Auth::user()->user_id);
    return view('account.edit', compact('user'));
  }
  public function update(Request $request, string $id)
  {
    try {
      dd($request->all());
    } catch (Exception $e) {
      Log::error("Error in AccountController@update: " . $e->getMessage());
      return back()->with('error', $e->getMessage());
    }
  }
}
