<?php

use App\Models\User;
use Filament\Pages\Auth\Login;
use Filament\Pages\Dashboard;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Livewire\livewire;

test('user can login to admin panel', function () {
    $user = User::factory()->create();

    livewire(Login::class)
        ->fillForm([
            'email' => $user->email,
            'password' => 'password',
        ])
        ->call('authenticate')
        ->assertHasNoFormErrors()
        ->assertRedirect(Dashboard::getUrl());

    assertAuthenticated();
});

test('user cannot login with invalid credentials', function () {
    $user = User::factory()->create();

    livewire(Login::class)
        ->fillForm([
            'email' => $user->email,
            'password' => 'wrong-password',
        ])
        ->call('authenticate')
        ->assertHasFormErrors(['email']);

    assertGuest();
});
