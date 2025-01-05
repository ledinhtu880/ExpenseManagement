<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
  use HasFactory;
  public $timestamps = false;
  protected $primaryKey = 'user_id';
  protected $fillable = [
    'name',
    'email',
    'email_education',
    'gender',
    'birthday',
    'identify_card',
    'password',
  ];
  protected $hidden = [
    'password',
  ];
  protected function casts(): array
  {
    return [
      'password' => 'hashed',
    ];
  }
  public function wallets()
  {
    return $this->hasMany(Wallet::class, 'user_id', 'user_id');
  }
  public function budgets()
  {
    return $this->hasMany(Budget::class, 'user_id', 'user_id');
  }
  public function recurringTransactions()
  {
    return $this->hasMany(RecurringTransaction::class, 'user_id', 'user_id');
  }
  public function events()
  {
    return $this->hasMany(Event::class, 'user_id', 'user_id');
  }
  public function transactions()
  {
    return $this->hasMany(Transaction::class, 'user_id', 'user_id');
  }
  public function debts()
  {
    return $this->hasMany(Debt::class, 'user_id', 'user_id');
  }
  public function getAgeAttribute()
  {
    return Carbon::parse($this->birthday)->age;
  }
  public function getFormattedGenderAttribute()
  {
    return $this->gender == 0 ? "Nam" : "Nữ";
  }
  public function getFormattedBirthdayAttribute()
  {
    return Carbon::parse($this->birthday)->format('d/m/Y');
  }
}
