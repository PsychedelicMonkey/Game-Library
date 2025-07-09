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
        Schema::create('library_reviews', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->foreignUlid('library_rating_id')->constrained('library_ratings')->cascadeOnDelete();
            $table->text('body');
            $table->boolean('is_public')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_reviews');
    }
};
