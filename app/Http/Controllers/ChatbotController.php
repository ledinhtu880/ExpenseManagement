<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use App\Models\ChatBotLog;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatbotController extends Controller
{
  protected $openAIService;

  public function __construct(OpenAIService $openAIService)
  {
    $this->openAIService = $openAIService;
  }
  public function showChat()
  {
    $userId = Auth::user()->user_id;
    $chatLogs = ChatBotLog::where('user_id', $userId)->orderBy('created_at', 'asc')->get();

    return view('chat', compact('chatLogs'));
  }
  public function createTransaction(Request $request)
  {
    $userId = Auth::user()->user_id;
    $message = $request->input('message');

    // Lưu tin nhắn của người dùng
    ChatBotLog::create([
      'user_id' => $userId,
      'message' => $message,
      'is_bot' => false,
      'created_at' => now(),
    ]);

    try {
      DB::beginTransaction();
      $response = $this->openAIService->generateTransaction($message);
      $transactionData = $this->parseTransactionResponse($response);

      if (!$transactionData['category_id']) {
        throw new \Exception("Category không hợp lệ hoặc không tồn tại");
      }

      // Convert date to Carbon instance for proper database storage
      $date = Carbon::createFromFormat('Y-m-d', $transactionData['date']);

      $transaction = Transaction::create([
        'category_id' => $transactionData['category_id'],
        'wallet_id' => $transactionData['wallet_id'],
        'amount' => $transactionData['amount'],
        'date' => $date,
        'note' => $transactionData['note'],
      ]);

      // Cập nhật số dư của ví
      $wallet = Wallet::find($transactionData['wallet_id']);
      $category = Category::find($transactionData['category_id']);

      if ($category->group_type == 1 || $category->group_type == 3) {
        // Khoản chi
        $wallet->balance -= $transactionData['amount'];
      } else {
        // Khoản thu
        $wallet->balance += $transactionData['amount'];
      }

      $wallet->save();

      // Lưu phản hồi của bot
      ChatBotLog::create([
        'user_id' => $userId,
        'message' => $response,
        'is_bot' => true,
        'created_at' => now(),
      ]);

      DB::commit();

      return response()->json([
        'message' => "Transaction created successfully",
        'data' => [
          'id' => $transaction->id,
          'amount' => $transaction->amount,
          'date' => $transaction->date->format('Y-m-d')
        ]
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error("Lỗi khi tạo giao dịch: " . $e->getMessage());
      return response()->json([
        'error' => "Không thể tạo giao dịch: " . $e->getMessage(),
      ], 400);
    }
  }
  private function parseTransactionResponse($response)
  {
    Log::info("OpenAI Response Raw: " . $response);

    $parsed = [];

    // Updated regex patterns to match new format
    preg_match('/Date: (\d{4}-\d{2}-\d{2})/', $response, $date);
    preg_match('/Description: (.+)/', $response, $description);
    preg_match('/Category: (.+)/', $response, $category);
    preg_match('/Amount: ([\d,\.]+) VND/', $response, $amount);

    // Parse date
    $parsed['date'] = $date[1] ?? now()->format('Y-m-d');

    // Parse description as note
    $parsed['note'] = $description[1] ?? null;

    // Parse category
    $categoryName = trim($category[1] ?? '');
    $parsed['category_id'] = $this->getCategoryId($categoryName);

    // Parse amount
    if (isset($amount[1])) {
      $parsed['amount'] = str_replace(',', '', $amount[1]);
    } else {
      throw new \Exception("Số tiền không hợp lệ hoặc không tồn tại");
    }

    // Set wallet ID
    $parsed['wallet_id'] = $this->getDefaultWalletId();

    return $parsed;
  }

  private function normalizeCategory($category)
  {
    // Loại bỏ khoảng trắng thừa và chuẩn hóa định dạng
    return trim(strtolower($category));
  }

  private function translateCategory($category)
  {
    $translations = [
      // Expenses (Khoản chi)
      'food' => 'Ăn uống',
      'food & beverage' => 'Ăn uống',
      'food & drinks' => 'Ăn uống',
      'meals' => 'Ăn uống',
      'dining' => 'Ăn uống',

      'shopping' => 'Mua sắm',
      'purchases' => 'Mua sắm',
      'buy' => 'Mua sắm',

      'transport' => 'Di chuyển',
      'transportation' => 'Di chuyển',
      'travel' => 'Di chuyển',
      'commute' => 'Di chuyển',

      'education' => 'Giáo dục',
      'study' => 'Giáo dục',
      'tuition' => 'Giáo dục',
      'school' => 'Giáo dục',

      'gift' => 'Quà tặng & Quyên góp',
      'donation' => 'Quà tặng & Quyên góp',
      'gifts & donations' => 'Quà tặng & Quyên góp',
      'charity' => 'Quà tặng & Quyên góp',

      'investment' => 'Đầu tư',
      'invest' => 'Đầu tư',
      'investing' => 'Đầu tư',

      'transfer out' => 'Tiền chuyển đi',
      'money sent' => 'Tiền chuyển đi',
      'sent money' => 'Tiền chuyển đi',

      'bills' => 'Hóa đơn & Tiện ích',
      'utilities' => 'Hóa đơn & Tiện ích',
      'utility bills' => 'Hóa đơn & Tiện ích',

      'family' => 'Gia đình',
      'household' => 'Gia đình',
      'home' => 'Gia đình',

      'health' => 'Sức khỏe',
      'healthcare' => 'Sức khỏe',
      'medical' => 'Sức khỏe',

      'entertainment' => 'Giải trí',
      'leisure' => 'Giải trí',
      'recreation' => 'Giải trí',

      'insurance' => 'Bảo hiểm',
      'coverage' => 'Bảo hiểm',

      'other expenses' => 'Các chi phí khác',
      'miscellaneous' => 'Các chi phí khác',
      'others' => 'Các chi phí khác',

      'interest payment' => 'Trả lãi',
      'pay interest' => 'Trả lãi',

      // Income (Khoản thu)
      'salary' => 'Lương',
      'wages' => 'Lương',
      'paycheck' => 'Lương',

      'transfer in' => 'Tiền chuyển đến',
      'money received' => 'Tiền chuyển đến',
      'received money' => 'Tiền chuyển đến',

      'other income' => 'Thu nhập khác',
      'misc income' => 'Thu nhập khác',

      'interest income' => 'Thu lãi',
      'interest earned' => 'Thu lãi',

      // Loans (Khoản vay)
      'lending' => 'Cho vay',
      'lend money' => 'Cho vay',
      'loan given' => 'Cho vay',

      'borrowing' => 'Đi vay',
      'borrow money' => 'Đi vay',
      'loan taken' => 'Đi vay',

      // Debts (Khoản nợ)
      'debt payment' => 'Trả nợ',
      'pay debt' => 'Trả nợ',
      'repayment' => 'Trả nợ',

      'debt collection' => 'Thu nợ',
      'collect debt' => 'Thu nợ',
      'debt recovery' => 'Thu nợ',

      // Uncategorized
      'uncategorized' => 'Chưa phân loại',
      'undefined' => 'Chưa phân loại',
      'unknown' => 'Chưa phân loại'
    ];

    $normalizedCategory = $this->normalizeCategory($category);

    if (!isset($translations[$normalizedCategory])) {
      Log::warning("Danh mục không được định nghĩa trong mảng dịch: " . $category);
    }

    return $translations[$normalizedCategory] ?? $category;
  }


  private function getDefaultWalletId()
  {
    // Fetch the wallet ID with the minimum ID for the authenticated user
    $userId = Auth::user()->id;
    return DB::table('wallets')
      ->where('user_id', $userId)
      ->orderBy('wallet_id', 'asc')
      ->value('wallet_id');
  }

  private function getCategoryId($categoryName)
  {
    $categoryId = DB::table('categories')->where('name', $categoryName)->value('category_id');

    if (!$categoryId) {
      Log::warning("Category không tồn tại trong cơ sở dữ liệu: " . $categoryName);
    }

    return $categoryId;
  }
}
