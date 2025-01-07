<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
  use HasFactory;

  protected $primaryKey = 'transaction_id';

  protected $fillable = [
    'wallet_id',
    'category_id',
    'event_id',
    'amount',
    'date',
    'note',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'category_id');
  }
  public function event()
  {
    return $this->belongsTo(Event::class, 'event_id', 'event_id');
  }
  public function wallet()
  {
    return $this->belongsTo(Wallet::class, 'wallet_id', 'wallet_id');
  }
  public function getFormattedDateAttribute()
  {
    return Carbon::parse($this->date)->format('d/m/Y');
  }
  protected function getExchangeRate($toCurrency)
  {
    $exchangeRates = [
      'USD' => 1,
      'VND' => 25000,
      'EUR' => 0.96,
    ];
    if ($toCurrency === 'USD') {
      return 1;
    }

    return 1 * $exchangeRates[$toCurrency];
  }
  public function getFormattedAmountAttribute()
  {
    $rate = $this->getExchangeRate($this->wallet->user->currency);
    return number_format($this->amount * $rate, 0, ',', '.') . ' ' . $this->wallet->user->currency;
  }
}
