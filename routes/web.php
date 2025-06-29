<?php

use App\Http\Controllers\Library\GameController;
use App\Models\Game;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('home', [
        'games' => Game::query()
            ->with(['developers', 'publishers', 'genres', 'platforms'])
            ->orderByDesc('release_date')
            ->limit(10)
            ->get(),

        'profiles' => Inertia::optional(fn () => Profile::query()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()),
    ]);
})->name('home');

Route::get('/about', function () {
    return Inertia::render('about');
})->name('about');

Route::get('/library/game/{game:slug}', [GameController::class, 'show'])->name('game.show');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
