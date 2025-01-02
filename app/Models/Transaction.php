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
    'user_id',
    'category_id',
    'event_id',
    'amount',
    'date',
    'note',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
  }
  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'category_id');
  }
  public function event()
  {
    return $this->belongsTo(Event::class, 'event_id', 'event_id');
  }
  public function getFormattedAmountAttribute()
  {
    return number_format($this->amount, 0, ',', '.') . ' VND';
  }
  public function getFormattedDateAttribute()
  {
    return Carbon::parse($this->date)->format('d/m/Y');
  }
}
