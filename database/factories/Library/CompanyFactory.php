<?php

namespace Database\Factories\Library;

use App\Models\Library\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Library\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * @var class-string<Company>
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->company(),
            'slug' => Str::slug($name),
            'description' => $this->faker->realText(),
            'is_visible' => $this->faker->boolean(),
            'is_featured' => $this->faker->boolean(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'date_formed' => $this->faker->dateTimeBetween('-40 year', '-1 year'),
            'date_defunct' => $this->faker->dateTimeBetween('-35 year'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month'),
        ];
    }
}
