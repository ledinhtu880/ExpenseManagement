<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   * 6. Recurring Transaction: Quản lý các giao dịch định kỳ 
   */
  public function up(): void
  {
    Schema::create('transactions', function (Blueprint $table) {
      $table->unsignedInteger('transaction_id', true)->primary();
      $table->unsignedInteger('user_id');
      $table->unsignedInteger('category_id');
      $table->unsignedInteger('event_id');
      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
      $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
      $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
      $table->decimal('amount', 10, 2);
      $table->dateTime('date')->useCurrent();
      $table->string('note')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('transactions');
  }
};