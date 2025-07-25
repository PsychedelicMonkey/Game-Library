<?php

declare(strict_types=1);

namespace Database\Factories\Library;

use App\Models\Library\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Library\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * @var class-string<Review>
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => $this->faker->realText(),
            'is_public' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month'),
        ];
    }
}
