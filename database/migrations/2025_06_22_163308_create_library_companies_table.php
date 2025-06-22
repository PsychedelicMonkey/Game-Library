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
        Schema::create('library_companies', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->foreignUlid('parent_id')->nullable()->constrained('library_companies')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->boolean('is_visible')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->date('date_formed')->nullable();
            $table->date('date_defunct')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_companies');
    }
};
