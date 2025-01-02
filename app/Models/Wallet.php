<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $primaryKey = 'wallet_id';
  protected $fillable = [
    'user_id',
    'name',
    'balance',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
  }
  public function getFormattedBalanceAttribute()
  {
    return number_format($this->balance, 0, ',', '.') . ' VND';
  }
}
