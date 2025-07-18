<?php

declare(strict_types=1);

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Clear expired password reset tokens.
Schedule::command('auth:clear-resets')->everyFifteenMinutes();

// Prune expired sanctum tokens.
Schedule::command('sanctum:prune-expired --hours=24')->daily();
