<?php

use App\Filament\Resources\Blog\CategoryResource;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(fn () => actingAs(User::factory()->create()));

test('category page can be rendered', function () {
get(CategoryResource::getUrl())
->assertSuccessful();
    });
