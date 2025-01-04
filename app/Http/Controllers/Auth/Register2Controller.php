<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Register2Controller extends Controller
{
    /**
     * Hiển thị form đăng ký thứ hai (register2.blade.php).
     */
    public function showRegister2Form()
    {
        return view('register2');
    }


    public function register2(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
        return redirect()->route('login');
    }
}
