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
        Schema::create('library_companies', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->ulid('parent_id')->nullable();
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

        Schema::table('library_companies', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('library_companies')->cascadeOnDelete();
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
