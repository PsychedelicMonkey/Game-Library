<?php

use App\Http\Controllers\Settings\AccountController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::patch('settings/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('settings/account', [AccountController::class, 'destroy'])->name('account.destroy');

    Route::get('settings/profile', [AccountController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');
});
