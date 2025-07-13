<?php

namespace Database\Factories\Library;

use App\Models\Library\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Library\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * @var class-string<Rating>
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'score' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month'),
        ];
    }

    public function configure(): Factory
    {
        return $this->afterCreating(function (Rating $rating) {
            $rating->review()->save(ReviewFactory::new()->make());
        });
    }
}
