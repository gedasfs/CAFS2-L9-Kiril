<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Products\ProductResource;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index(Request $request, ProductService $productService)
    {
        $products = $productService->get($request->only('category_id', 'search', 'order_by'));

        return ProductResource::collection($products);
    }
}
