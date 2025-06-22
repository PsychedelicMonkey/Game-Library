<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Closure;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\ProgressBar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::raw('SET time_zone=\'+00:00\'');

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
        $this->withProgressBar(1000, fn () => Game::factory(1)
            ->hasAttached($companies->random(rand(1, 3)), relationship: 'developers')
            ->hasAttached($companies->random(rand(1, 3)), relationship: 'publishers')
            ->hasAttached($genres->random(rand(1, 3)), relationship: 'genres')
            ->hasAttached($platforms->random(rand(1, 3)), relationship: 'platforms')
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
