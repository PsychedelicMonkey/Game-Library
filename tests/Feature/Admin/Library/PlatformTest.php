<?php

use App\Filament\Clusters\Library\Resources\PlatformResource;
use App\Models\Library\Game;
use App\Models\Library\Platform;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Str;

use function Pest\Livewire\livewire;

beforeEach(fn () => $this->actingAs(User::factory()->create()));

describe('list platforms', function () {
    test('can render page', function () {
        $this->get(PlatformResource::getUrl())
            ->assertSuccessful();
    });

    test('can list platforms', function () {
        $platforms = Platform::factory()->count(10)->create();

        livewire(PlatformResource\Pages\ListPlatforms::class)
            ->assertCanSeeTableRecords($platforms);
    });
});

describe('create platforms', function () {
    test('can render page', function () {
        $this->get(PlatformResource\Pages\CreatePlatform::getUrl())
            ->assertSuccessful();
    });

    test('can automatically generate a slug from the name', function () {
        $name = fake()->sentence();

        livewire(PlatformResource\Pages\CreatePlatform::class)
            ->fillForm([
                'name' => $name,
            ])
            ->assertFormSet(function (array $state) use ($name): array {
                expect($state['slug'])
                    ->not->toContain(' ');

                return [
                    'slug' => Str::slug($name),
                ];
            });
    });

    test('can create', function () {
        $newData = Platform::factory()->make();

        livewire(PlatformResource\Pages\CreatePlatform::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->slug,
                'description' => $newData->description,
                'is_visible' => $newData->is_visible,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(Platform::class, [
            'name' => $newData->name,
            'slug' => $newData->slug,
            'description' => $newData->description,
            'is_visible' => $newData->is_visible,
        ]);
    });

    test('can validate input', function () {
        livewire(PlatformResource\Pages\CreatePlatform::class)
            ->fillForm([
                'name' => null,
            ])
            ->call('create')
            ->assertHasFormErrors(['name' => 'required']);
    });
});

describe('edit platforms', function () {
    test('can render page', function () {
        $this->get(PlatformResource::getUrl('edit', [
            'record' => Platform::factory()->create(),
        ]))->assertSuccessful();
    });

    test('can retrieve data', function () {
        $platform = Platform::factory()->create();

        livewire(PlatformResource\Pages\EditPlatform::class, [
            'record' => $platform->getRouteKey(),
        ])
            ->assertFormSet([
                // TODO: test relation managers.

                'name' => $platform->name,
                'slug' => $platform->slug,
                'description' => $platform->description,
                'is_visible' => $platform->is_visible,
            ]);
    });
    // TODO: test relation managers.

    test('can save', function () {
        $platform = Platform::factory()->create();
        $newData = Platform::factory()->make();

        livewire(PlatformResource\Pages\EditPlatform::class, [
            'record' => $platform->getRouteKey(),
        ])
            // TODO: test relation managers.

            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->slug,
                'description' => $newData->description,
                'is_visible' => $newData->is_visible,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->expect($platform->refresh())
            ->name->toBe($newData->name)
            ->slug->toBe($newData->slug)
            ->description->toBe($newData->description)
            ->is_visible->toBe($newData->is_visible);
    });

    test('can validate input', function () {
        $platform = Platform::factory()->create();

        livewire(PlatformResource\Pages\EditPlatform::class, [
            'record' => $platform->getRouteKey(),
        ])
            ->fillForm([
                'name' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['name' => 'required']);
    });

    test('can delete', function () {
        $platform = Platform::factory()->create();

        livewire(PlatformResource\Pages\EditPlatform::class, [
            'record' => $platform->getRouteKey(),
        ])
            ->callAction(DeleteAction::class);

        $this->assertModelMissing($platform);
    });
});

describe('relation manager', function () {
    test('can render relation manager', function () {
        $platform = Platform::factory()
            ->hasAttached(Game::factory()->count(10))
            ->create();

        livewire(PlatformResource\RelationManagers\GamesRelationManager::class, [
            'ownerRecord' => $platform,
            'pageClass' => PlatformResource\Pages\EditPlatform::class,
        ])
            ->assertSuccessful();
    });

    test('can list games', function () {
        $platform = Platform::factory()
            ->hasAttached(Game::factory()->count(10))
            ->create();

        livewire(PlatformResource\RelationManagers\GamesRelationManager::class, [
            'ownerRecord' => $platform,
            'pageClass' => PlatformResource\Pages\EditPlatform::class,
        ])
            ->assertCanSeeTableRecords($platform->games);
    });
});
