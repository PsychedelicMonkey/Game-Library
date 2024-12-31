<?php

use App\Filament\Clusters\Library\Resources\GenreResource;
use App\Models\Library\Game;
use App\Models\Library\Genre;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Str;

use function Pest\Livewire\livewire;

beforeEach(fn () => $this->actingAs(User::factory()->create()));

describe('list genres', function () {
    test('can render page', function () {
        $this->get(GenreResource::getUrl())
            ->assertSuccessful();
    });

    test('can list genres', function () {
        $genres = Genre::factory()->count(10)->create();

        livewire(GenreResource\Pages\ListGenres::class)
            ->assertCanSeeTableRecords($genres);
    });
});

describe('create genres', function () {
    test('can render page', function () {
        $this->get(GenreResource\Pages\CreateGenre::getUrl())
            ->assertSuccessful();
    });

    test('can automatically generate a slug from the name', function () {
        $name = fake()->sentence();

        livewire(GenreResource\Pages\CreateGenre::class)
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
        $newData = Genre::factory()->make();

        livewire(GenreResource\Pages\CreateGenre::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->slug,
                'description' => $newData->description,
                'is_visible' => $newData->is_visible,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(Genre::class, [
            'name' => $newData->name,
            'slug' => $newData->slug,
            'description' => $newData->description,
            'is_visible' => $newData->is_visible,
        ]);
    });

    test('can validate input', function () {
        livewire(GenreResource\Pages\CreateGenre::class)
            ->fillForm([
                'name' => null,
            ])
            ->call('create')
            ->assertHasFormErrors(['name' => 'required']);
    });
});

describe('edit genres', function () {
    test('can render page', function () {
        $this->get(GenreResource::getUrl('edit', [
            'record' => Genre::factory()->create(),
        ]))->assertSuccessful();
    });

    test('can retrieve data', function () {
        $genre = Genre::factory()->create();

        livewire(GenreResource\Pages\EditGenre::class, [
            'record' => $genre->getRouteKey(),
        ])
            ->assertFormSet([
                'name' => $genre->name,
                'slug' => $genre->slug,
                'description' => $genre->description,
                'is_visible' => $genre->is_visible,
            ]);
    });

    test('can save', function () {
        $genre = Genre::factory()->create();
        $newData = Genre::factory()->make();

        livewire(GenreResource\Pages\EditGenre::class, [
            'record' => $genre->getRouteKey(),
        ])
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->slug,
                'description' => $newData->description,
                'is_visible' => $newData->is_visible,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->expect($genre->refresh())
            ->name->toBe($newData->name)
            ->slug->toBe($newData->slug)
            ->description->toBe($newData->description)
            ->is_visible->toBe($newData->is_visible);
    });

    test('can validate input', function () {
        $genre = Genre::factory()->create();

        livewire(GenreResource\Pages\EditGenre::class, [
            'record' => $genre->getRouteKey(),
        ])
            ->fillForm([
                'name' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['name' => 'required']);
    });

    test('can delete', function () {
        $genre = Genre::factory()->create();

        livewire(GenreResource\Pages\EditGenre::class, [
            'record' => $genre->getRouteKey(),
        ])
            ->callAction(DeleteAction::class);

        $this->assertModelMissing($genre);
    });
});

describe('relation manager', function () {
    test('can render relation manager', function () {
        $genre = Genre::factory()
            ->hasAttached(Game::factory()->count(10))
            ->create();

        livewire(GenreResource\RelationManagers\GamesRelationManager::class, [
            'ownerRecord' => $genre,
            'pageClass' => GenreResource\Pages\EditGenre::class,
        ])
            ->assertSuccessful();
    });

    test('can list games', function () {
        $genre = Genre::factory()
            ->hasAttached(Game::factory()->count(10))
            ->create();

        livewire(GenreResource\RelationManagers\GamesRelationManager::class, [
            'ownerRecord' => $genre,
            'pageClass' => GenreResource\Pages\EditGenre::class,
        ])
            ->assertCanSeeTableRecords($genre->games);
    });
});
