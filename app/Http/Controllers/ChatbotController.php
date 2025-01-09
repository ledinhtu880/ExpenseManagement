<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatBotLog;
use App\Models\Transaction;

class ChatbotController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function createTransaction(Request $request)
    {
        $userId = auth()->id(); // Assuming user is authenticated
        $message = $request->input('message');

        // Log the message
        ChatBotLog::create([
            'user_id' => $userId,
            'message' => $message,
        ]);

        // Call OpenAI to generate transaction details
        $response = $this->openAIService->generateTransaction($message);
        $transactionData = $this->parseTransactionResponse($response);

        // Save the transaction
        $transaction = Transaction::create([
            'category_id' => $transactionData['category_id'],
            'wallet_id' => $transactionData['wallet_id'],
            'amount' => $transactionData['amount'],
            'date' => now(),
            'note' => $transactionData['note'],
        ]);

        return response()->json([
            'message' => "Transaction created successfully: " . $transaction->amount,
        ]);
    }

    private function parseTransactionResponse($response)
    {
        // This function parses the OpenAI response into structured data
        // Example: "Transaction: Category: Food & Beverage, Amount: 50,000 VND"
        $parsed = [];
        preg_match('/Category: ([\w &]+)/', $response, $category);
        preg_match('/Amount: ([\d,\.]+) VND/', $response, $amount);

        Log::info("Response: ", ['response' => $response]);
        Log::info("1", ['category' => $amount[1]]);

        $parsed['category_id'] = isset($category[1]) ? $this->getCategoryId($this->translateCategory($category[1])) : null;
        $parsed['wallet_id'] = $this->getDefaultWalletId(); // Assuming you have a default wallet
        $parsed['amount'] = isset($amount[1]) ? str_replace(',', '', $amount[1]) : null;
        $parsed['note'] = null; // Assuming no note in the response

        return $parsed;
    }

    private function translateCategory($category)
    {
        // Translate English category to Vietnamese
        $translations = [
            'Food' => 'Ăn uống',
            'Food & Beverage' => 'Ăn uống',
            'Food & Drinks' => 'Ăn uống',
            // Add more translations as needed
        ];

        return $translations[$category] ?? $category;
    }

    private function getDefaultWalletId()
    {
        // Fetch the wallet ID with the minimum ID for the authenticated user
        $userId = Auth::user()->user_id;
        return DB::table('wallets')
            ->where('user_id', $userId)
            ->orderBy('wallet_id', 'asc')
            ->value('wallet_id');
    }

    private function getCategoryId($categoryName)
    {
        // Fetch category ID by name
        Log::info($categoryName);
        return DB::table('categories')->where('name', $categoryName)->value('category_id');
    }

    private function getWalletId($walletName)
    {
        // Fetch wallet ID by name
        return DB::table('wallets')->where('name', $walletName)->value('wallet_id');
    }
}
