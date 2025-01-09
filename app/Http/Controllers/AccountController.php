<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AccountUpdateRequest;
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
      $data = $request->except(['identify_card', 'isStudent']);

      if ($request->identify_card !== 'Chưa có thông tin') {
        $data['identify_card'] = $request->identify_card;
      }

      if ($request->hasFile('isStudent')) {
        try {
            $file = $request->file('isStudent');
            $filePath = $file->storeAs('temp', uniqid() . '_' . $file->getClientOriginalName(), 'public');
            $fullImagePath = storage_path('app/public/' . $filePath);
    
            $pythonPath = escapeshellarg("C:\\Users\\Lenovo\\AppData\\Local\\Programs\\Python\\Python39\\python.exe");
            $scriptPath = escapeshellarg(base_path('python/detection.py'));
            $userName = escapeshellarg($user->name);
            $imagePath = escapeshellarg($fullImagePath);
    
            $command = "$pythonPath $scriptPath $userName $imagePath 2>&1";
            
            $output = shell_exec($command);
            Log::info("Python script raw output: " . $output);
    
            $result = json_decode($output, true);
    
            if (is_null($result)) {
                throw new Exception("Invalid JSON response from Python script");
            }
    
            if (!$result['success']) {
                throw new Exception($result['message']);
            }
    
            if ($result['is_valid']) {
                $data['isStudent'] = 1;
            } else {
                throw new Exception($result['message']);
            }
    
            if (file_exists($fullImagePath)) {
                unlink($fullImagePath);
            }
    
        } catch (Exception $e) {
            Log::error("Student card verification error: " . $e->getMessage());
            throw new Exception("Lỗi khi xử lý thẻ sinh viên: " . $e->getMessage());
        }
    }

      // Cập nhật thông tin người dùng
      $user->update($data);
      return redirect()->back()->with('type', 'success')
        ->with('message', 'Cập nhật thông tin người dùng thành công.');
    } catch (Exception $e) {
      Log::error("Error in AccountController@update: " . $e->getMessage());
      return redirect()->back()->with('type', 'danger')->with('message', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
  }
}
