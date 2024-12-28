<?php

use App\Filament\Resources\AuthorResource;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(fn () => actingAs(User::factory()->create()));

test('author page can be rendered', function () {
    get(AuthorResource::getUrl())
        ->assertSuccessful();
});
