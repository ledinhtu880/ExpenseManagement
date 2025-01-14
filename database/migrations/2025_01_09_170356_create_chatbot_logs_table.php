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
    Schema::create('chatbot_logs', function (Blueprint $table) {
      $table->unsignedInteger('log_id', true)->primary();
      $table->unsignedInteger('user_id');
      $table->text('message');
      $table->boolean('is_bot');
      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
      $table->dateTime('created_at')->nullable()->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('chatbot_logs');
  }
};
