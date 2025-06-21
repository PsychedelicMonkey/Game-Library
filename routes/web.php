<?php

use App\Models\Profile;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $profiles = Profile::query()
        ->get();

    return Inertia::render('home', compact('profiles'));
})->name('home');

Route::get('/about', function () {
    return Inertia::render('about');
})->name('about');

require __DIR__.'/auth.php';
