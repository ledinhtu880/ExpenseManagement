<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class TransactionController extends Controller
{
  public function store(Request $request)
  {
    // Validate input data
    $request->validate([
      'amount' => 'required|numeric|min:0',
      'category_id' => 'required|exists:categories,category_id',
      'note' => 'nullable|string|max:255',
      'date' => 'required|date',
      'wallet_id' => 'required|exists:wallets,wallet_id',
    ]);

    // Get the user's currency
    $userCurrency = Auth::user()->currency;

    // Get the exchange rate from the user's currency to USD
    $rate = $this->getExchangeRate($userCurrency, 'USD');

    // Convert the amount to USD
    $amountInUSD = $request->input('amount') / $rate;

    // Create the transaction
    try {

      DB::beginTransaction();
      Transaction::create([
        'amount' => $amountInUSD,
        'category_id' => $request->input('category_id'),
        'note' => $request->input('note', ''),
        'date' => $request->input('date'),
        'wallet_id' => $request->input('wallet_id'),
      ]);
      DB::commit();

      // Redirect or return response (you can adjust this based on your needs)
      return redirect()->back()->with('message', 'Tạo giao dịch thành công!')->with('type', 'success');
    } catch (\Exception $e) {
      // Log the error
      Log::error('Error in TransactionController@store', ['error' => $e->getMessage()]);

      // Return a response with an error message
      DB::rollBack();
      return redirect()->back()->with('message', 'Không tạo được giao dịch. Vui lòng thử lại')->with('type', 'danger');
    }
  }
  public function update(Request $request, string $id)
  {
    // Create the transaction
    try {
      // Redirect or return response (you can adjust this based on your needs)
      return redirect()->back()->with('message', 'Cập nhật giao dịch thành công!')->with('type', 'success');
    } catch (\Exception $e) {
      // Log the error
      Log::error('Error in TransactionController@update', ['error' => $e->getMessage()]);

      // Return a response with an error message
      DB::rollBack();
      return redirect()->back()->with('message', 'Không thể chỉnh sửa giao dịch. Vui lòng thử lại!')->with('type', 'danger');
    }
  }
  protected function getExchangeRate($fromCurrency, $toCurrency)
  {
    $exchangeRates = [
      'USD' => 1,
      'VND' => 25000,
      'EUR' => 0.96,
    ];

    if ($fromCurrency === $toCurrency) {
      return 1;
    }

    return $exchangeRates[$fromCurrency] / $exchangeRates[$toCurrency];
  }
}
