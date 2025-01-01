<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('recurring_transactions', function (Blueprint $table) {
      $table->unsignedInteger('recurring_transaction_idw', true)->primary();
      $table->unsignedInteger('user_id');
      $table->unsignedInteger('category_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
      $table->enum('frequency', ['Hằng ngày', 'Hàng tuần', 'Hàng tháng', 'Hàng năm']);
      $table->date('start_date');
      $table->date('end_date')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('recurring_transactions');
  }
};
