<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatBotLog extends Model
{
  protected $table = 'chatbot_logs';
  protected $primaryKey = 'log_id';
  protected $fillable = [
    'user_id',
    'message',
  ];
}
