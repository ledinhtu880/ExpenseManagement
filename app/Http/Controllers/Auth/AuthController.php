<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class AuthController extends Controller
{
  public function register()
  {
    return view("auth.register");
  }
  public function handleRegister(Request $request)
  {
    try {
      $data = $request->all();
      if (User::where('email', $data['email'])->exists()) {
        return response()->json(['status' => 'danger', 'message' => 'Tài khoản đã tồn tại']);
      }

      DB::beginTransaction();
      User::create([
        'name' => $data["name"],
        'birthday' => $data["birthday"],
        'gender' => $data["gender"],
        'email' => $data["email"],
        'password' => $data["password"],
      ]);
      DB::commit();

      $res = redirect()->route('login')
        ->with('type', 'success')
        ->with('message', 'Đăng ký thành công');
      return response()->json([
        'status' => 'success',
        'url' => $res->getTargetUrl(),
      ]);
    } catch (Exception $e) {
      Log::error("Error in Register" . $e->getMessage());
      return response()->json(['status' => 'danger', 'message' => 'Có lỗi xảy ra, xin vui lòng thử lại!']);
    }
  }

  public function login()
  {
    return view('auth.login');
  }
}
