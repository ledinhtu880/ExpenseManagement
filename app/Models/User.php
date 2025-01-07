<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
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

  // Cac ham lien quan den quan he giua cac model
  public function wallets()
  {
    return $this->hasMany(Wallet::class, 'user_id', 'user_id');
  }
  public function budgets()
  {
    return $this->hasMany(Budget::class, 'user_id', 'user_id');
  }
  public function transactions()
  {
    return $this->hasManyThrough(
      Transaction::class, // Model đích
      Wallet::class, // Model trung gian
      'user_id', // Khóa ngoại trên model trung gian (Wallet) trỏ đến model hiện tại (User)
      'wallet_id', // Khóa ngoại trên model đích (Transaction) trỏ đến model trung gian (Wallet)
      'user_id', // Khóa chính trên model hiện tại (User)
      'wallet_id' // Khóa chính trên model đích (Transaction)
    );
  }
  public function recurringTransactions()
  {
    return $this->hasMany(RecurringTransaction::class, 'user_id', 'user_id');
  }
  public function events()
  {
    return $this->hasMany(Event::class, 'user_id', 'user_id');
  }
  public function debts()
  {
    return $this->hasMany(Debt::class, 'user_id', 'user_id');
  }

  // Cac ham lien quan den formatted
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
  public function getTotalBalanceAttribute()
  {
    $total = 0;
    foreach ($this->wallets as $wallet) {
      $rate = $this->getExchangeRate($this->currency);
      $total += $wallet->balance * $rate;
    }

    return number_format($total, 0, ',', '.') . ' ' . $this->currency;
  }


  public function topWallets($limit = 3)
  {
    return $this->wallets()->orderBy('balance', 'desc')->take($limit)->get();
  }
  public function getConvertedBalanceAttribute()
  {
    $rate = $this->getExchangeRate($this->currency);
    return $this->total_amount * $rate;
  }
  private function formatCurrency($amount)
  {
    return number_format($amount, 0, ',', '.') . ' ' . $this->currency;
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
  // Cac ham lien quan den lay du lieu Category va Wallet
  public function getWeeklyCategoryExpenses()
  {
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();

    $transactions = $this->transactions()
      ->whereBetween('date', [$startOfWeek, $endOfWeek])
      ->with('category') // Eager load category
      ->get();

    $totalSpent = $transactions->sum('amount');
    $rate = $this->getExchangeRate($this->currency);
    Log::info($rate);

    $categoryExpenses = $transactions->groupBy('category_id')->map(function ($categoryTransactions) use ($totalSpent, $rate) {
      $categoryTotal = $categoryTransactions->sum('amount');
      $categoryTotalConverted = $categoryTotal * $rate;
      $percentage = $totalSpent > 0 ? ($categoryTotal / $totalSpent) * 100 : 0;
      $categoryName = $categoryTransactions->first()->category->name;

      return [
        'total' => $this->formatCurrency($categoryTotalConverted),
        'percentage' => number_format($percentage, 2) . '%',
        'name' => $categoryName,
      ];
    });

    return $categoryExpenses;
  }
  public function getMonthlyCategoryExpenses()
  {
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    $transactions = $this->transactions()
      ->whereBetween('date', [$startOfMonth, $endOfMonth])
      ->with('category') // Eager load category
      ->get();

    $totalSpent = $transactions->sum('amount');
    $rate = $this->getExchangeRate($this->currency);

    $categoryExpenses = $transactions->groupBy('category_id')
      ->map(function ($categoryTransactions) use ($totalSpent, $rate) {
        $categoryTotal = $categoryTransactions->sum('amount') * $rate;
        $percentage = $totalSpent > 0 ? ($categoryTotal / ($totalSpent * $rate)) * 100 : 0;
        $categoryName = $categoryTransactions->first()->category->name;

        return [
          'total' => $this->formatCurrency($categoryTotal),
          'percentage' => number_format($percentage, 2) . '%',
          'name' => $categoryName,
        ];
      });

    return $categoryExpenses;
  }
  public function getWeeklyExpenses()
  {
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();

    $expenses = $this->transactions()
      ->whereBetween('date', [$startOfWeek, $endOfWeek])
      ->selectRaw('DATE(date) as date, SUM(amount) as total')
      ->groupBy('date', 'wallets.user_id')
      ->get()
      ->keyBy('date');

    $rate = $this->getExchangeRate($this->currency);

    $weeklyExpenses = [];
    for ($date = $startOfWeek; $date <= $endOfWeek; $date->addDay()) {
      $formattedDate = $date->format('l'); // Định dạng ngày thành tên ngày trong tuần
      $dayOfWeek = $this->getDayOfWeekInVietnamese($formattedDate);
      $weeklyExpenses[$dayOfWeek] = $expenses->has($date->format('Y-m-d')) ? $expenses[$date->format('Y-m-d')]->total * $rate : 0;
    }

    return $weeklyExpenses;
  }
  public function getMonthlyExpenses()
  {
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    $expenses = $this->transactions()
      ->whereBetween('date', [$startOfMonth, $endOfMonth])
      ->selectRaw('WEEK(date) as week, MIN(date) as start_date, MAX(date) as end_date, SUM(amount) as total')
      ->groupBy('week', 'wallets.user_id')
      ->get()
      ->keyBy('week');

    $rate = $this->getExchangeRate($this->currency);

    $monthlyExpenses = [];
    $currentDate = $startOfMonth->copy();
    while ($currentDate <= $endOfMonth) {
      $week = $currentDate->weekOfMonth;
      $startOfWeek = $currentDate->copy()->startOfWeek();
      $endOfWeek = $currentDate->copy()->endOfWeek();
      if ($endOfWeek > $endOfMonth) {
        $endOfWeek = $endOfMonth;
      }

      $weekLabel = 'Tuần ' . $week . ' [' . $startOfWeek->format('d/m/Y') . ' => ' . $endOfWeek->format('d/m/Y') . ']';
      $monthlyExpenses[$weekLabel] = $expenses->has($week) ? $expenses[$week]->total * $rate : 0;

      $currentDate->addWeek();
    }

    return $monthlyExpenses;
  }
  private function getDayOfWeekInVietnamese($dayOfWeek)
  {
    $days = [
      'Monday' => 'Thứ 2',
      'Tuesday' => 'Thứ 3',
      'Wednesday' => 'Thứ 4',
      'Thursday' => 'Thứ 5',
      'Friday' => 'Thứ 6',
      'Saturday' => 'Thứ 7',
      'Sunday' => 'Chủ Nhật',
    ];

    return $days[$dayOfWeek];
  }
  public function getTodayTransactions()
  {
    $startOfDay = Carbon::now()->startOfDay();
    $endOfDay = Carbon::now()->endOfDay();

    return $this->transactions()
      ->whereBetween('date', [$startOfDay, $endOfDay])
      ->with('category') // Eager load category
      ->get();
  }
}
