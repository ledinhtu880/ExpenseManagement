<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function show()
    {
        return view('currency'); // Hiển thị view currency.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'currency' => 'required|string',
        ]);

        // Lưu đơn vị tiền tệ vào session hoặc cơ sở dữ liệu
        session(['currency' => $request->currency]);

        // Chuyển hướng đến trang dashboard hoặc trang chính
        return redirect()->route('dashboard')->with('success', 'Đơn vị tiền tệ đã được lưu.');
    }
}

