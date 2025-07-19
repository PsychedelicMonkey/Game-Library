<?php

declare(strict_types=1);

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Library\GameController;
use App\Http\Controllers\Library\RatingController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)
    ->middleware('throttle:global')
    ->name('home');

Route::get('/about', AboutController::class)
    ->middleware('throttle:global')
    ->name('about');

Route::get('/library/game/{game:slug}', [GameController::class, 'show'])
    ->middleware('throttle:global')
    ->name('game.show');

Route::post('/library/rating/', [RatingController::class, 'store'])
    ->middleware('auth')
    ->name('rating.store');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
