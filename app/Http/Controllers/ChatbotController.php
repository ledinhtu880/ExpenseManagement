<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use App\Models\ChatBotLog;
use App\Models\Transaction;
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

    // Then, update the createTransaction method to use the parsed date
    // Update createTransaction to explicitly convert the date
    public function createTransaction(Request $request)
    {
        $userId = auth()->id();
        $message = $request->input('message');

        ChatBotLog::create([
            'user_id' => $userId,
            'message' => $message,
        ]);

        try {
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

            Log::info("Tạo thành công giao dịch: {$transaction->id} với ngày {$transaction->date}");

            return response()->json([
                'message' => "Transaction created successfully",
                'data' => [
                    'id' => $transaction->id,
                    'amount' => $transaction->amount,
                    'date' => $transaction->date->format('Y-m-d')
                ]
            ]);

        } catch (\Exception $e) {
            Log::error("Lỗi khi tạo giao dịch: " . $e->getMessage());
            return response()->json([
                'error' => "Không thể tạo giao dịch: " . $e->getMessage(),
            ], 400);
        }
    }
    // First, add a helper method to parse various date formats
    private function parseDateFormat($dateString)
    {
        // Remove any extra spaces
        $dateString = trim($dateString);

        try {
            // Handle d/m/Y format (e.g., 7/1/2025)
            if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $dateString, $matches)) {
                return sprintf('%04d-%02d-%02d', $matches[3], $matches[2], $matches[1]);
            }

            // Handle Y-m-d format (already in correct format)
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateString)) {
                return $dateString;
            }

            // Handle relative dates in Vietnamese
            switch (strtolower($dateString)) {
                case 'hôm nay':
                    return now()->format('Y-m-d');
                case 'hôm qua':
                    return now()->subDay()->format('Y-m-d');
                case 'ngày mai':
                    return now()->addDay()->format('Y-m-d');
            }

            // If no match, try to parse with Carbon
            return Carbon::parse($dateString)->format('Y-m-d');
        } catch (\Exception $e) {
            Log::warning("Không thể parse ngày: " . $dateString . ". Error: " . $e->getMessage());
            return now()->format('Y-m-d');
        }
    }
    // First, update the parseTransactionResponse method to extract date
    // Update parseTransactionResponse to use the new date parsing
    private function parseTransactionResponse($response) {
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
        $parsed['amount'] = isset($amount[1]) ? str_replace(',', '', $amount[1]) : null;
    
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


    private function getDefaultCategoryId()
    {
        // Lấy ID của danh mục mặc định như "Khác"
        return DB::table('categories')->where('name', 'Khác')->value('category_id') ?? 1;
    }

}
