<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ProductCategory::factory(5)->create();
    
        Product::factory(30) ->state(new Sequence(
            fn ($sequence) => ['category_id' => $categories->random()],
        ))->create();
    }
}
