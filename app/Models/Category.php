<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;
  protected $primaryKey = 'category_id';
  protected $fillable = [
    'name',
    'type',
    'type_team',
  ];

  public function budgets()
  {
    return $this->hasMany(Budget::class, 'category_id', 'category_id');
  }
  public function recurringTransactions()
  {
    return $this->hasMany(RecurringTransaction::class, 'category_id', 'category_id');
  }
  public function transactions()
  {
    return $this->hasMany(Transaction::class, 'category_id', 'category_id');
  }
  public function debts()
  {
    return $this->hasMany(Debt::class, 'category_id', 'category_id');
  }
}