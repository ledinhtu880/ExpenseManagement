<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AccountUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Exception;
use PayOS\PayOS;

class AccountController extends Controller
{
  private $payOS;
  private $orderCode;
  public function __construct()
  {
    $this->payOS = new PayOS(
      env("PAYOS_CLIENT_ID"),
      env("PAYOS_API_KEY"),
      env("PAYOS_CHECKSUM_KEY")
    );
  }
  public static function handleException(\Throwable $th)
  {
    return response()->json([
      "error" => $th->getCode(),
      "message" => $th->getMessage(),
      "data" => null
    ]);
  }
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
  public function createPaymentLink(Request $request)
  {
    $user = Auth::user();
    $YOUR_DOMAIN = $request->getSchemeAndHttpHost();

    $amount = $user->isStudent == 1 ? 48000 : 60000;

    $data = [
      "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
      "amount" => $amount,
      "description" => "Nâng cấp tài khoản",
      "returnUrl" => $YOUR_DOMAIN . "/accounts/handlePaymentSuccess",
      "cancelUrl" => $YOUR_DOMAIN . "/account"
    ];

    try {
      $response = $this->payOS->createPaymentLink($data);
      $orderCode = $response['orderCode'];
      return response()->json([
        'success' => true,
        'checkoutUrl' => $response['checkoutUrl']
      ]);
    } catch (\Throwable $th) {
      return PayosController::handleException($th);
    }
  }
  public function handlePaymentSuccess(Request $request)
  {
    try {
      $isPaid = $request->get('status');
      $user = User::find(Auth::user()->user_id);
      if ($isPaid) {
        $user->isPremium = true;
        $user->save();
      }

      return redirect()->route('accounts.index')
        ->with('type', 'success')
        ->with('message', 'Nâng cấp tài khoản thành công');
    } catch (Exception $e) {
      Log::error("Loi tu verify: " . $e->getMessage());
      return redirect()->route('accounts.index')
        ->with('type', 'danger')
        ->with('message', 'Có lỗi xảy ra, vui lòng thử lại sau');
    }
  }
}
