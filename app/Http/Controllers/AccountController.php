<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AccountUpdateRequest;
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
  public function update(AccountUpdateRequest $request, string $id)
  {
    try {
      $user = User::find($id);

      $data = $request->except(['identify_card']);

      if ($request->identify_card !== 'Chưa có thông tin') {
        $data['identify_card'] = $request->identify_card;
      }

      $user->update($data);
      return redirect()->route('accounts.edit')
        ->with('type', 'success')
        ->with('message', 'Cập nhật thông tin người dùng thành công');
    } catch (Exception $e) {
      Log::error("Error in AccountController@update: " . $e->getMessage());
      return back()->with('error', $e->getMessage());
    }
  }
}
