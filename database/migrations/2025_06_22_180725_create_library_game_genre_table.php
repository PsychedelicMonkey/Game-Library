<?php

declare(strict_types=1);

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
        Schema::create('library_game_genre', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('library_game_id')->constrained('library_games')->cascadeOnDelete();
            $table->foreignUlid('library_genre_id')->constrained('library_genres')->cascadeOnDelete();
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_game_genre');
    }
};
