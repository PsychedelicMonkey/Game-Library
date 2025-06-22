<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * @var class-string<Game>
     */
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->unique()->sentence(),
            'slug' => Str::slug($title),
            'description' => $this->faker->realText(500),
            'is_visible' => $this->faker->boolean(),
            'is_featured' => $this->faker->boolean(),
            'release_date' => $this->faker->dateTimeBetween('-35 years', '-1 year'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month'),
        ];
    }
}
