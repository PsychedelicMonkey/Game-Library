<?php

use App\Models\Profile;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('home', [
        'profiles' => Inertia::optional(fn () => Profile::query()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()),
    ]);
})->name('home');

Route::get('/about', function () {
    return Inertia::render('about');
})->name('about');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
