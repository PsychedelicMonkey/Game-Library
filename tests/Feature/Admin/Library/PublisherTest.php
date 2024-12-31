<?php

use App\Filament\Clusters\Library\Resources\PublisherResource;
use App\Models\Library\Game;
use App\Models\Library\Publisher;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Str;

use function Pest\Livewire\livewire;

beforeEach(fn () => $this->actingAs(User::factory()->create()));

describe('list publishers', function () {
    test('can render page', function () {
        $this->get(PublisherResource::getUrl())
            ->assertSuccessful();
    });

    test('can list publishers', function () {
        $publishers = Publisher::factory()->count(10)->create();

        livewire(PublisherResource\Pages\ListPublishers::class)
            ->assertCanSeeTableRecords($publishers);
    });
});

describe('create publishers', function () {
    test('can render page', function () {
        $this->get(PublisherResource\Pages\CreatePublisher::getUrl())
            ->assertSuccessful();
    });

    test('can automatically generate a slug from the name', function () {
        $name = fake()->sentence();

        livewire(PublisherResource\Pages\CreatePublisher::class)
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
        $newData = Publisher::factory()->make();

        livewire(PublisherResource\Pages\CreatePublisher::class)
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->slug,
                'description' => $newData->description,
                'is_visible' => $newData->is_visible,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(Publisher::class, [
            'name' => $newData->name,
            'slug' => $newData->slug,
            'description' => $newData->description,
            'is_visible' => $newData->is_visible,
        ]);
    });

    test('can validate input', function () {
        livewire(PublisherResource\Pages\CreatePublisher::class)
            ->fillForm([
                'name' => null,
            ])
            ->call('create')
            ->assertHasFormErrors(['name' => 'required']);
    });
});

describe('edit publishers', function () {
    test('can render page', function () {
        $this->get(PublisherResource::getUrl('edit', [
            'record' => Publisher::factory()->create(),
        ]))->assertSuccessful();
    });

    test('can retrieve data', function () {
        $publisher = Publisher::factory()->create();

        livewire(PublisherResource\Pages\EditPublisher::class, [
            'record' => $publisher->getRouteKey(),
        ])
            ->assertFormSet([
                'name' => $publisher->name,
                'slug' => $publisher->slug,
                'description' => $publisher->description,
                'is_visible' => $publisher->is_visible,
            ]);
    });

    test('can save', function () {
        $publisher = Publisher::factory()->create();
        $newData = Publisher::factory()->make();

        livewire(PublisherResource\Pages\EditPublisher::class, [
            'record' => $publisher->getRouteKey(),
        ])
            ->fillForm([
                'name' => $newData->name,
                'slug' => $newData->slug,
                'description' => $newData->description,
                'is_visible' => $newData->is_visible,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->expect($publisher->refresh())
            ->name->toBe($newData->name)
            ->slug->toBe($newData->slug)
            ->description->toBe($newData->description)
            ->is_visible->toBe($newData->is_visible);
    });

    test('can validate input', function () {
        $publisher = Publisher::factory()->create();

        livewire(PublisherResource\Pages\EditPublisher::class, [
            'record' => $publisher->getRouteKey(),
        ])
            ->fillForm([
                'name' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['name' => 'required']);
    });

    test('can delete', function () {
        $publisher = Publisher::factory()->create();

        livewire(PublisherResource\Pages\EditPublisher::class, [
            'record' => $publisher->getRouteKey(),
        ])
            ->callAction(DeleteAction::class);

        $this->assertModelMissing($publisher);
    });
});

describe('relation manager', function () {
    test('can render relation manager', function () {
        $publisher = Publisher::factory()
            ->hasAttached(Game::factory()->count(10))
            ->create();

        livewire(PublisherResource\RelationManagers\GamesRelationManager::class, [
            'ownerRecord' => $publisher,
            'pageClass' => PublisherResource\Pages\EditPublisher::class,
        ])
            ->assertSuccessful();
    });

    test('can list games', function () {
        $publisher = Publisher::factory()
            ->hasAttached(Game::factory()->count(10))
            ->create();

        livewire(PublisherResource\RelationManagers\GamesRelationManager::class, [
            'ownerRecord' => $publisher,
            'pageClass' => PublisherResource\Pages\EditPublisher::class,
        ])
            ->assertCanSeeTableRecords($publisher->games);
    });
});
