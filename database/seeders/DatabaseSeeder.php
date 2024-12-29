<?php

namespace Database\Seeders;

use App\Models\Blog\Author;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Library\Developer;
use App\Models\Library\Game;
use App\Models\Library\Genre;
use App\Models\Library\Platform;
use App\Models\Library\Publisher;
use App\Models\Library\Review;
use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\ProgressBar;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::raw('SET time_zone=\'+00:00\'');

        // Admin
        $this->command->warn(PHP_EOL . 'Creating admin user...');
        $user = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]));
        $this->command->info('Admin user created.');

        $this->command->warn(PHP_EOL . 'Creating guest users...');
        $guests = $this->withProgressBar(1000, fn () => User::factory(1)
            ->create());
        $this->command->info('Guest users created.');

        // Library
        $this->command->warn(PHP_EOL . 'Creating library developers...');
        $developers = $this->withProgressBar(20, fn () => Developer::factory(1)
            ->create());
        $this->command->info('Library developers created.');

        $this->command->warn(PHP_EOL . 'Creating library publishers...');
        $publishers = $this->withProgressBar(20, fn () => Publisher::factory(1)
            ->create());
        $this->command->info('Library publishers created.');

        $this->command->warn(PHP_EOL . 'Creating library genres...');
        $genres = $this->withProgressBar(20, fn () => Genre::factory(1)
            ->create());
        $this->command->info('Library genres created.');

        $this->command->warn(PHP_EOL . 'Creating library platforms...');
        $platforms = $this->withProgressBar(20, fn () => Platform::factory(1)
            ->create());
        $this->command->info('Library platforms created.');

        $this->command->warn(PHP_EOL . 'Creating library games...');
        $games = $this->withProgressBar(1000, fn () => Game::factory(1)
            ->hasAttached($developers->random(rand(1, 3)))
            ->hasAttached($publishers->random(rand(1, 3)))
            ->hasAttached($genres->random(rand(1, 3)))
            ->hasAttached($platforms->random(rand(1, 3)))
            ->create());
        $this->command->info('Library games created.');

        $this->command->warn(PHP_EOL . 'Creating library reviews...');
        $this->withProgressBar(100, fn () => Review::factory(1)
            ->sequence(fn ($sequence) => [
                'library_game_id' => $games->random(1)->first()->id,
                'user_id' => $guests->random(1)->first()->id,
            ])
            ->create());
        $this->command->info('Library reviews created.');

        // Blog
        $this->command->warn(PHP_EOL . 'Creating blog categories...');
        $categories = $this->withProgressBar(20, fn () => Category::factory(1)
            ->create());
        $this->command->info('Blog categories created.');

        $this->command->warn(PHP_EOL . 'Creating blog authors and posts...');
        $this->withProgressBar(20, fn () => Author::factory(1)
            ->has(
                Post::factory()->count(5)
                    ->state(fn (array $attributes, Author $author) => ['blog_category_id' => $categories->random(1)->first()->id]),
                'posts'
            )
            ->create());
        $this->command->info('Blog authors and posts created.');
    }

    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);

        $progressBar->start();

        $items = new Collection;

        foreach (range(1, $amount) as $item) {
            $items = $items->merge(
                $createCollectionOfOne()
            );

            $progressBar->advance();
        }

        $progressBar->finish();

        $this->command->getOutput()->writeln('');

        return $items;
    }
}
