<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('register', function () {
    return Inertia::render('auth/register');
})->name('register');

Route::get('login', function () {
    return Inertia::render('auth/login');
})->name('login');
