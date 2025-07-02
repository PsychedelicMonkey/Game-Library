<?php

use App\Http\Controllers\Library\GameController;
use App\Models\Game;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $games = Game::query()
        ->where('is_visible', true)
        ->with(['developers', 'publishers', 'genres', 'platforms'])
        ->latest('release_date')
        ->limit(10)
        ->get();

    $profiles = Inertia::optional(fn () => Profile::query()
        ->with('media')
        ->latest()
        ->limit(10)
        ->get()
        ->setHidden(['media'])
    );

    return Inertia::render('home', compact('games', 'profiles'));
})->name('home');

Route::get('/about', function () {
    return Inertia::render('about');
})->name('about');

Route::get('/library/game/{game:slug}', [GameController::class, 'show'])->name('game.show');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
