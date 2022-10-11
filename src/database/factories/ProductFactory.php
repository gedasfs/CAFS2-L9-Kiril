<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'is_active' => fake()->boolean(),
            'name' => fake()->words(3, true),
            'description' => fake()->text(100),
            'identifier' => fake()->ean13(),
            'stock' => fake()->numberBetween(0, 10),
            'price' => fake()->randomFloat(1, 20, 30)
        ];
    }
}
