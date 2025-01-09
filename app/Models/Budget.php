<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Budget extends Model
{
  use HasFactory;
  protected $primaryKey = 'budget_id';
  protected $fillable = [
    'user_id',
    'category_id',
    'amount',
    'start_date',
    'end_date'
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
  }
  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'category_id');
  }
  public function getIdAttribute()
  {
    return $this->budget_id;
  }
  public function getFormattedAmountAttribute()
  {
    return number_format($this->amount, 0, ',', '.') . ' VND';
  }
  public function getFormattedStartDateAttribute()
  {
    return Carbon::parse($this->start_date)->format('d/m/Y');
  }
  public function getFormattedEndDateAttribute()
  {
    return Carbon::parse($this->end_date)->format('d/m/Y');
  }
}
