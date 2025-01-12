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
        Schema::create('library_game_platform', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();

            $table->foreignUlid('library_game_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('library_platform_id')->constrained()->cascadeOnDelete();
            $table->string('url')->nullable();
            $table->date('release_date')->nullable();
            $table->unsignedSmallInteger('sort')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_game_platform');
    }
};
