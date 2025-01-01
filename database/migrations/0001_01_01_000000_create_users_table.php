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
    Schema::create('users', function (Blueprint $table) {
      $table->unsignedInteger('user_id', true)->primary();
      $table->string('name', 100);
      $table->string('email', 40)->unique();
      $table->string('email_education', 40)->unique()->nullable();
      $table->boolean('gender'); // 0 - M, 1 - F
      $table->date('birthday');
      $table->string('identify_card')->unique()->nullable();
      $table->string('password');
      $table->datetime('created_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
