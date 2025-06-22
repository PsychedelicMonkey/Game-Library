<?php

namespace Database\Factories;

use App\Enums\PlatformType;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Platform>
 */
class PlatformFactory extends Factory
{
    /**
     * @var class-string<Platform>
     */
    protected $model = Platform::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->word(),
            'slug' => Str::slug($name),
            'description' => $this->faker->realText(),
            'is_visible' => $this->faker->boolean(),
            'is_featured' => $this->faker->boolean(),
            'release_date' => $this->faker->dateTimeBetween('-35 year', '-1 year'),
            'discontinued_date' => $this->faker->dateTimeBetween('-30 year', '-1 year'),
            'type' => $this->faker->randomElement(PlatformType::class),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month'),
        ];
    }
}
