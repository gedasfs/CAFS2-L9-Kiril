<?php

namespace Tests\Feature\Api\V1\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testProductsFetchSuccess()
    {
        $products = Product::factory(10)->create();

        $response = $this->get('/api/v1/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'category',
                        'stock',
                        'name',
                        'description',
                        'identifier',
                        'price',
                    ]
                ]
            ]);
    }

    public function testActiveProductsFetchSuccess()
    {
        $products = Product::factory(10)->create();

        $response = $this->get('/api/v1/products');

        $response->assertStatus(200)->assertJsonCount($products->where('is_active', true)->count(), 'data.*');
    }

    public function testNotActiveProductsFetchSuccess()
    {
        $products = Product::factory(10)->create([
            'is_active' => false
        ]);

        $response = $this->get('/api/v1/products');

        $response->assertStatus(200)->assertJsonCount(0, 'data.*');
    }
}