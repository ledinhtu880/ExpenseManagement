<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class AuthController extends Controller
{
  public function register()
  {
    if (Auth::check()) {
      return redirect()->route('budget.index');
    } else {
      return view('auth.register');
    }
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
  public function handleLogin(Request $request)
  {
    try {
      $email = $request->get('email');
      $user = User::where('email', $email)->first();
      if (!$user) {
        return redirect()->back()->with('type', 'warning')->with('message', 'Tài khoản chưa tồn tại. Vui lòng đăng ký');
      } else if (Hash::check($request->get('password'), $user->password)) {
        Auth::login($user);
        return redirect()->intended('')
          ->with('type', 'success')
          ->with('message', 'Đăng nhập thành công');
      } else {
        return redirect()->back()->with('type', 'warning')->with('message', 'Đăng nhập không thành công. Sai thông tin tài khoản/mật khẩu. Hãy kiểm tra lại!');
      }
    } catch (Exception $e) {
      return response()->json([
        'status' => 'danger',
        'message' => $e->getMessage(),
      ]);
    }
  }
  public function login()
  {
    if (Auth::check()) {
      return redirect()->route('budget.index');
    } else {
      return view('auth.login');
    }
  }
  public function logout()
  {
    Auth::logout();
    session()->flush();
    return redirect()->route('login')->with('type', 'success')->with('message', 'Đăng xuất thành công');
  }
}
