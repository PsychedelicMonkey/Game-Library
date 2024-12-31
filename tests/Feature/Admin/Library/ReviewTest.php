<?php

use App\Filament\Resources\Library\ReviewResource;
use App\Models\Library\Game;
use App\Models\Library\Review;
use App\Models\User;
use Filament\Actions\DeleteAction;

use function Pest\Livewire\livewire;

beforeEach(fn () => $this->actingAs(User::factory()->create()));

describe('list reviews', function () {
    test('can render page', function () {
        $this->get(ReviewResource::getUrl('index'))
            ->assertSuccessful();
    });

    test('can list reviews', function () {
        $reviews = Review::factory()->count(10)->create([
            'library_game_id' => Game::factory(),
            'user_id' => User::factory(),
        ]);

        livewire(ReviewResource\Pages\ListReviews::class)
            ->assertCanSeeTableRecords($reviews);
    });
});

describe('create reviews', function () {
    test('can render page', function () {
        $this->get(ReviewResource::getUrl('create'))
            ->assertSuccessful();
    });

    test('can create', function () {
        $newData = Review::factory()->make([
            'library_game_id' => Game::factory(),
            'user_id' => User::factory(),
        ]);

        livewire(ReviewResource\Pages\CreateReview::class)
            ->fillForm([
                'library_game_id' => $newData->game->getKey(),
                'user_id' => $newData->user->getKey(),
                'title' => $newData->title,
                'content' => $newData->content,
                'published_at' => $newData->published_at,
                'is_visible' => $newData->is_visible,
                'is_featured' => $newData->is_featured,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(Review::class, [
            'library_game_id' => $newData->game->getKey(),
            'user_id' => $newData->user->getKey(),
            'title' => $newData->title,
            'content' => $newData->content,
            'published_at' => $newData->published_at,
            'is_visible' => $newData->is_visible,
            'is_featured' => $newData->is_featured,
        ]);
    });

    test('can validate input', function () {
        livewire(ReviewResource\Pages\CreateReview::class)
            ->fillForm([
                'title' => null,
            ])
            ->call('create')
            ->assertHasFormErrors(['title' => 'required']);
    });
});

describe('edit reviews', function () {
    test('can render page', function () {
        $this->get(ReviewResource::getUrl('edit', [
            'record' => Review::factory()->create([
                'library_game_id' => Game::factory(),
                'user_id' => User::factory(),
            ]),
        ]))->assertSuccessful();
    });

    test('can retrieve data', function () {
        $review = Review::factory()->create([
            'library_game_id' => Game::factory(),
            'user_id' => User::factory(),
        ]);

        livewire(ReviewResource\Pages\EditReview::class, [
            'record' => $review->getRouteKey(),
        ])
            ->assertFormSet([
                'library_game_id' => $review->game->getKey(),
                'user_id' => $review->user->getKey(),
                'title' => $review->title,
                'content' => $review->content,
                'published_at' => $review->published_at,
                'is_visible' => $review->is_visible,
                'is_featured' => $review->is_featured,
            ]);
    });

    test('can save', function () {
        $review = Review::factory()->create([
            'library_game_id' => Game::factory(),
            'user_id' => User::factory(),
        ]);

        $newData = Review::factory()->make([
            'library_game_id' => Game::factory(),
            'user_id' => User::factory(),
        ]);

        livewire(ReviewResource\Pages\EditReview::class, [
            'record' => $review->getRouteKey(),
        ])
            ->fillForm([
                'library_game_id' => $newData->game->getKey(),
                'user_id' => $newData->user->getKey(),
                'title' => $newData->title,
                'content' => $newData->content,
                'published_at' => $newData->published_at,
                'is_visible' => $newData->is_visible,
                'is_featured' => $newData->is_featured,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->expect($review->refresh())
            ->library_game_id->toBe($newData->game->getKey())
            ->user_id->toBe($newData->user->getKey())
            ->title->toBe($newData->title)
            ->content->toBe($newData->content)
            ->is_visible->toBe($newData->is_visible)
            ->is_featured->toBe($newData->is_featured);
    });

    test('can validate input', function () {
        $review = Review::factory()->create([
            'library_game_id' => Game::factory(),
            'user_id' => User::factory(),
        ]);
        livewire(ReviewResource\Pages\EditReview::class, [
            'record' => $review->getRouteKey(),
        ])
            ->fillForm([
                'title' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['title' => 'required']);
    });

    test('can delete', function () {
        $review = Review::factory()->create([
            'library_game_id' => Game::factory(),
            'user_id' => User::factory(),
        ]);

        livewire(ReviewResource\Pages\EditReview::class, [
            'record' => $review->getRouteKey(),
        ])
            ->callAction(DeleteAction::class);

        $this->assertModelMissing($review);
    });
});
