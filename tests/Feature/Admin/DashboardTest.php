<?php

use App\Models\User;
use Filament\Pages\Dashboard;

use function Pest\Laravel\actingAs;

test('dashboard can be rendered', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(Dashboard::getUrl())
        ->assertSuccessful();
});
