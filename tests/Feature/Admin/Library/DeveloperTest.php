<?php

use App\Filament\Clusters\Library\Resources\DeveloperResource;
use App\Models\Library\Developer;
use App\Models\Library\Game;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Str;

use function Pest\Livewire\livewire;

beforeEach(fn () => $this->actingAs(User::factory()->create()));

describe('list developers', function () {
    test('can render page', function () {
        $this->get(DeveloperResource::getUrl())
            ->assertSuccessful();
    });

    test('can list developers', function () {
        $developers = Developer::factory()->count(10)->create();

        livewire(DeveloperResource\Pages\ListDevelopers::class)
            ->assertCanSeeTableRecords($developers);
    });
});

describe('create developers', function () {
    test('can render page', function () {
        $this->get(DeveloperResource\Pages\CreateDeveloper::getUrl())
            ->assertSuccessful();
    });

    test('can automatically generate a slug from the name', function () {
        $name = fake()->sentence();

        livewire(DeveloperResource\Pages\CreateDeveloper::class)
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
        $newData = Developer::factory()->make();

        livewire(DeveloperResource\Pages\CreateDeveloper::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->slug,
                'description' => $newData->description,
                'is_visible' => $newData->is_visible,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(Developer::class, [
            'name' => $newData->name,
            'slug' => $newData->slug,
            'description' => $newData->description,
            'is_visible' => $newData->is_visible,
        ]);
    });

    test('can validate input', function () {
        livewire(DeveloperResource\Pages\CreateDeveloper::class)
            ->fillForm([
                'name' => null,
            ])
            ->call('create')
            ->assertHasFormErrors(['name' => 'required']);
    });
});

describe('edit developers', function () {
    test('can render page', function () {
        $this->get(DeveloperResource::getUrl('edit', [
            'record' => Developer::factory()->create(),
        ]))->assertSuccessful();
    });

    test('can retrieve data', function () {
        $developer = Developer::factory()->create();

        livewire(DeveloperResource\Pages\EditDeveloper::class, [
            'record' => $developer->getRouteKey(),
        ])
            ->assertFormSet([
                'name' => $developer->name,
                'slug' => $developer->slug,
                'description' => $developer->description,
                'is_visible' => $developer->is_visible,
            ]);
    });

    test('can save', function () {
        $developer = Developer::factory()->create();
        $newData = Developer::factory()->make();

        livewire(DeveloperResource\Pages\EditDeveloper::class, [
            'record' => $developer->getRouteKey(),
        ])
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->slug,
                'description' => $newData->description,
                'is_visible' => $newData->is_visible,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->expect($developer->refresh())
            ->name->toBe($newData->name)
            ->slug->toBe($newData->slug)
            ->description->toBe($newData->description)
            ->is_visible->toBe($newData->is_visible);
    });

    test('can validate input', function () {
        $developer = Developer::factory()->create();

        livewire(DeveloperResource\Pages\EditDeveloper::class, [
            'record' => $developer->getRouteKey(),
        ])
            ->fillForm([
                'name' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['name' => 'required']);
    });

    test('can delete', function () {
        $developer = Developer::factory()->create();

        livewire(DeveloperResource\Pages\EditDeveloper::class, [
            'record' => $developer->getRouteKey(),
        ])
            ->callAction(DeleteAction::class);

        $this->assertModelMissing($developer);
    });
});

describe('relation manager', function () {
    test('can render relation manager', function () {
        $developer = Developer::factory()
            ->hasAttached(Game::factory()->count(10))
            ->create();

        livewire(DeveloperResource\RelationManagers\GamesRelationManager::class, [
            'ownerRecord' => $developer,
            'pageClass' => DeveloperResource\Pages\EditDeveloper::class,
        ])
            ->assertSuccessful();
    });

    test('can list games', function () {
        $developer = Developer::factory()
            ->hasAttached(Game::factory()->count(10))
            ->create();

        livewire(DeveloperResource\RelationManagers\GamesRelationManager::class, [
            'ownerRecord' => $developer,
            'pageClass' => DeveloperResource\Pages\EditDeveloper::class,
        ])
            ->assertCanSeeTableRecords($developer->games);
    });
});
