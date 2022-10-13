<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ProductCategory;

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
            'category_id' => ProductCategory::factory(),
            'name' => fake()->words(3, true),
            'description' => fake()->text(200),
            'identifier' => fake()->ean13(),
            'stock' => fake()->numberBetween(1, 10)
        ];
    }
}
