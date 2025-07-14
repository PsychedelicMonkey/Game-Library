<?php

declare(strict_types=1);

use App\Http\Controllers\Settings\AccountController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\UploadAvatarController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::patch('settings/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('settings/account', [AccountController::class, 'destroy'])->name('account.destroy');

    Route::put('settings/password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('settings/profile', [AccountController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('settings/upload-avatar', UploadAvatarController::class)->name('upload-avatar');
});
