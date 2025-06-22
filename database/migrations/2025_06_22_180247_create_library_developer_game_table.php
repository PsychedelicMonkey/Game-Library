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
        Schema::create('library_developer_game', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('library_developer_id')->constrained('library_companies')->cascadeOnDelete();
            $table->foreignUlid('library_game_id')->constrained('library_games')->cascadeOnDelete();
            $table->boolean('is_primary')->default(false);
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_developer_game');
    }
};
