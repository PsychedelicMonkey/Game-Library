<?php

namespace Database\Seeders;

use App\Models\Library\Company;
use App\Models\Library\Game;
use App\Models\Library\Genre;
use App\Models\Library\Platform;
use App\Models\Library\Rating;
use App\Models\Tag;
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

        // Guest users
        $this->command->warn(PHP_EOL.'Creating guest users...');
        $users = $this->withProgressBar(1000, fn () => User::factory(1)
            ->create());
        $this->command->info('Guest users created.');

        // Tags
        $this->command->warn(PHP_EOL.'Creating tags');
        $tags = $this->withProgressBar(100, fn () => Tag::factory(1)
            ->create());
        $this->command->info('Tags created.');

        // Library
        $this->command->warn(PHP_EOL.'Creating library companies...');
        $companies = $this->withProgressBar(100, fn () => Company::factory(1)
            ->has(
                Company::factory(3),
                'children'
            )
            ->create());
        $this->command->info('Library companies created.');

        $this->command->warn(PHP_EOL.'Creating library genres...');
        $genres = $this->withProgressBar(50, fn () => Genre::factory(1)
            ->create());
        $this->command->info('Library genres created.');

        $this->command->warn(PHP_EOL.'Creating library platforms...');
        $platforms = $this->withProgressBar(50, fn () => Platform::factory(1)
            ->create());
        $this->command->info('Library platforms created.');

        $this->command->warn(PHP_EOL.'Creating library games...');
        $games = $this->withProgressBar(500, fn () => Game::factory(1)
            ->hasAttached($companies->random(rand(1, 3)), relationship: 'developers')
            ->hasAttached($companies->random(rand(1, 3)), relationship: 'publishers')
            ->hasAttached($genres->random(rand(1, 3)), relationship: 'genres')
            ->hasAttached($platforms->random(rand(1, 3)), relationship: 'platforms')
            ->hasAttached($tags->random(rand(5, 10)))
            ->has(
                Rating::factory(rand(5, 10))
                    ->state(fn (array $attributes, Game $game) => ['user_profile_id' => $users->random(1)->first()->profile->id]),
                'ratings'
            )
            ->create());
        $this->command->info('Library games created.');
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
