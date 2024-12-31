<?php

use App\Filament\Resources\Blog\PostResource;
use App\Models\Blog\Author;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Illuminate\Support\Str;

use function Pest\Livewire\livewire;

beforeEach(fn () => $this->actingAs(User::factory()->create()));

describe('list posts', function () {
    test('post page can be rendered', function () {
        $this->get(PostResource::getUrl())
            ->assertSuccessful();
    });

    test('can lists posts', function () {
        $posts = Post::factory(10)->create([
            'blog_author_id' => Author::factory(),
            'blog_category_id' => Category::factory(),
        ]);

        livewire(PostResource\Pages\ListPosts::class)
            ->assertCanSeeTableRecords($posts);
    });
});

describe('create posts', function () {
    test('can render page', function () {
        $this->get(PostResource::getUrl('create'))
            ->assertSuccessful();
    });

    test('can automatically generate a slug from the title', function () {
        $title = fake()->sentence();

        livewire(PostResource\Pages\CreatePost::class)
            ->fillForm([
                'title' => $title,
            ])
            ->assertFormSet(function (array $state) use ($title): array {
                expect($state['slug'])
                    ->not->toContain(' ');

                return [
                    'slug' => Str::slug($title),
                ];
            });
    });

    test('can create', function () {
        $newData = Post::factory()->make([
            'blog_author_id' => Author::factory(),
            'blog_category_id' => Category::factory(),
        ]);

        livewire(PostResource\Pages\CreatePost::class)
            ->fillForm([
                'blog_author_id' => $newData->author->getKey(),
                'blog_category_id' => $newData->category->getKey(),
                'title' => $newData->title,
                'slug' => $newData->slug,
                'content' => $newData->content,
                'published_at' => $newData->published_at,
                'status' => $newData->status,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(Post::class, [
            'blog_author_id' => $newData->author->getKey(),
            'blog_category_id' => $newData->category->getKey(),
            'title' => $newData->title,
            'slug' => $newData->slug,
            'content' => $newData->content,
            'published_at' => $newData->published_at,
            'status' => $newData->status,
        ]);
    });

    test('can validate input', function () {
        livewire(PostResource\Pages\CreatePost::class)
            ->fillForm([
                'title' => null,
            ])
            ->call('create')
            ->assertHasFormErrors(['title' => 'required']);
    });
});

describe('edit posts', function () {
    test('can render page', function () {
        $this->get(PostResource::getUrl('edit', [
            'record' => Post::factory()->create([
                'blog_author_id' => Author::factory(),
                'blog_category_id' => Category::factory(),
            ]),
        ]))
            ->assertSuccessful();
    });

    test('can retrieve data', function () {
        $post = Post::factory()->create([
            'blog_author_id' => Author::factory(),
            'blog_category_id' => Category::factory(),
        ]);

        livewire(PostResource\Pages\EditPost::class, [
            'record' => $post->getRouteKey(),
        ])
            ->assertFormSet([
                'blog_author_id' => $post->author->getKey(),
                'blog_category_id' => $post->category->getKey(),
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'published_at' => $post->published_at,
                'status' => $post->status->value,
            ]);
    });

    test('can save', function () {
        $post = Post::factory()->create([
            'blog_author_id' => Author::factory(),
            'blog_category_id' => Category::factory(),
        ]);

        $newData = Post::factory()->make([
            'blog_author_id' => Author::factory(),
            'blog_category_id' => Category::factory(),
        ]);

        livewire(PostResource\Pages\EditPost::class, [
            'record' => $post->getRouteKey(),
        ])
            ->fillForm([
                'blog_author_id' => $newData->author->getKey(),
                'blog_category_id' => $newData->category->getKey(),
                'title' => $newData->title,
                'slug' => $newData->slug,
                'content' => $newData->content,
                'published_at' => $newData->published_at,
                'status' => $newData->status,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->expect($post->refresh())
            ->blog_author_id->toBe($newData->author->getKey())
            ->blog_category_id->toBe($newData->category->getKey())
            ->title->toBe($newData->title)
            ->slug->toBe($newData->slug)
            ->content->toBe($newData->content)
            ->status->toBe($newData->status);

        // TODO: assert published_at is the same.
    });

    test('can validate input', function () {
        $post = Post::factory()->create([
            'blog_author_id' => Author::factory(),
            'blog_category_id' => Category::factory(),
        ]);

        livewire(PostResource\Pages\EditPost::class, [
            'record' => $post->getRouteKey(),
        ])
            ->fillForm([
                'title' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['title' => 'required']);
    });
});

describe('deleting', function () {
    test('can delete', function () {
        $post = Post::factory()->create([
            'blog_author_id' => Author::factory(),
            'blog_category_id' => Category::factory(),
        ]);

        livewire(PostResource\Pages\EditPost::class, [
            'record' => $post->getRouteKey(),
        ])
            ->callAction(DeleteAction::class);

        $this->assertSoftDeleted($post);
    });

    test('can restore', function () {
        $post = Post::factory()->create([
            'blog_author_id' => Author::factory(),
            'blog_category_id' => Category::factory(),
        ]);

        $post->delete();

        livewire(PostResource\Pages\EditPost::class, [
            'record' => $post->getRouteKey(),
        ])
            ->callAction(RestoreAction::class);

        $this->assertNotSoftDeleted($post);
    });

    test('can force delete', function () {
        $post = Post::factory()->create([
            'blog_author_id' => Author::factory(),
            'blog_category_id' => Category::factory(),
        ]);

        $post->delete();

        livewire(PostResource\Pages\EditPost::class, [
            'record' => $post->getRouteKey(),
        ])
            ->callAction(ForceDeleteAction::class);

        $this->assertModelMissing($post);
    });
});
