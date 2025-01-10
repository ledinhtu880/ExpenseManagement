<?php

namespace App\Services;

use OpenAI;
use GuzzleHttp\Client;

class OpenAIService
{
  protected $client;

  public function __construct()
  {
    // Khởi tạo Guzzle client với `verify => false`
    $httpClient = new Client([
      'base_uri' => 'https://api.openai.com/v1',
      'headers' => [
        'Authorization' => 'Bearer ' . config('services.openai.key'),
      ],
      'verify' => false, // Tắt xác minh SSL
    ]);

    // Sử dụng HTTP client đã chỉnh sửa
    $this->client = OpenAI::factory()->withHttpClient($httpClient)->make();
  }

  public function generateTransaction($message)
  {
    // Format the system prompt to generate the desired response format
    $systemPrompt = "You are a financial transaction assistant. Analyze the user's message and return transaction details in this exact format:
Transaction generated:
- Date: YYYY-MM-DD (if not provided, use today's date)
- Description: [brief description]
- Category: [category name]
- Amount: [amount] VND (if not provided, return an error message)
    
Categories must be one of: Ăn uống, Mua sắm, Di chuyển, Giáo dục, Quà tặng & Quyên góp, Hóa đơn & Tiện ích, Gia đình, Sức khỏe, Giải trí, Bảo hiểm, Đầu tư, Các chi phí khác, Tiền chuyển đi, Trả lãi, Chưa phân loại, Lương,
Thu nhập khác, Tiền chuyển đến, Thu lãi, Cho vay, Đi vay, Trả nợ, Thu nợ, etc.
Always include all four elements in the exact order shown above. If the date is not provided, use today's date.";

    // Your existing OpenAI API call logic here
    $response = $this->client->chat()->create([
      'model' => 'gpt-3.5-turbo',
      'messages' => [
        ['role' => 'system', 'content' => $systemPrompt],
        ['role' => 'user', 'content' => $message]
      ]
    ]);

    return $response->choices[0]->message->content;
  }
}
