<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\ProductService;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreProductServiceSuccess()
    {
        $category = ProductCategory::factory()->create();

        $service = resolve(ProductService::class);

        $data = [
            'category_id' => $category->id,

            'name' => fake()->words(3, true),
            'description' => fake()->text(200),

            'identifier' => fake()->ean13(),

            // 'stock' => fake()->numberBetween(1, 10),
            // 'price' => fake()->numberBetween(1, 300)
        ];

        $service->save($data);

        $data['is_active'] = 1;

        $this->assertDatabaseCount('products', 1);

        $this->assertDatabaseHas('products', $data);
    }

    public function testUpdateProductServiceSuccess()
    {
        $product = Product::factory()->create();

        $category = ProductCategory::factory()->create();

        $service = resolve(ProductService::class);

        $data = [
            'category_id' => $category->id,

            'name' => fake()->words(3, true),
            'description' => fake()->text(200),

            'identifier' => fake()->ean13(),

            'stock' => fake()->numberBetween(1, 10),
            'price' => fake()->numberBetween(1, 300)
        ];

        $service->save($data, $product);

        $data['id'] = $product->id;

        $this->assertDatabaseHas('products', $data);
    }
}
