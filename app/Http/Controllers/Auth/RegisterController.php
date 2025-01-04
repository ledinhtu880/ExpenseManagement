<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Hiển thị form đăng ký (register.blade.php).
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Xử lý dữ liệu đăng ký từ form đầu tiên và chuyển hướng đến form thứ hai.
     */
    public function register(Request $request)
    {
        // Xử lý dữ liệu đăng ký (nếu cần, ví dụ validate)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'identity_card' => 'required|string|max:20',
        ]);

        // Có thể lưu dữ liệu tạm thời trong session hoặc database
        $request->session()->put('register_data', $request->all());

        // Chuyển hướng đến form thứ hai (register2.blade.php)
        return redirect()->route('register2');
    }
}

