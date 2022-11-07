<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\Products\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return ProductResource::collection($products);
    }
}
