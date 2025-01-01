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
    Schema::create('debts', function (Blueprint $table) {
      $table->unsignedInteger('debt_id', true)->primary();
      $table->unsignedInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->decimal('amount', 10, 2)->default(0);
      $table->string('lender_borrower_name');
      $table->unsignedInteger('category_id');
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('');
      $table->date('date');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('debts');
  }
};
