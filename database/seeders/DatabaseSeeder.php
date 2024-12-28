<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
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
        $this->command->warn(PHP_EOL.'Creating admin user...');
        $user = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]));
        $this->command->info('Admin user created.');

        // Blog
        $this->command->warn(PHP_EOL.'Creating blog categories...');
        $categories = $this->withProgressBar(20, fn () => Category::factory(1)
            ->create());
        $this->command->info('Blog categories created.');

        $this->command->warn(PHP_EOL.'Creating blog authors and posts...');
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
