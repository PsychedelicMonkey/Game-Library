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
        Schema::create('library_ratings', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->foreignUlid('library_game_id')->constrained('library_games')->cascadeOnDelete();
            $table->foreignUlid('user_profile_id')->nullable()->constrained('user_profiles')->nullOnDelete();
            $table->unsignedSmallInteger('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_ratings');
    }
};
