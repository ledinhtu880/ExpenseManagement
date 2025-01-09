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
    Schema::create('categories', function (Blueprint $table) {
      $table->unsignedInteger('category_id', true)->primary();
      $table->string('name');
      $table->unsignedInteger('group_type_id');
      $table->string('icon')->nullable();
      $table->foreign('group_type_id')->references('group_type_id')->on('group_types')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('categories');
  }
};
