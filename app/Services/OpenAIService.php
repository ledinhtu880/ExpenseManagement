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

    public function generateTransaction($input)
    {
        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo', // Thay đổi mô hình
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a financial assistant helping users to generate transactions.',
                ],
                [
                    'role' => 'user',
                    'content' => "Generate a transaction based on the following user input: $input",
                ],
            ],
            'max_tokens' => 150,
            'temperature' => 0.7,
        ]);

        return $response['choices'][0]['message']['content'];
    }
    
}
