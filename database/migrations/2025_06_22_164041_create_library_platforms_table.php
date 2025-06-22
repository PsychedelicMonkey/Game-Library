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
        Schema::create('library_platforms', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->boolean('is_visible')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->date('release_date')->nullable();
            $table->date('discontinued_date')->nullable();
            $table->enum('type', ['console', 'service']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_platforms');
    }
};
