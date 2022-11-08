<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Resources\Products\ProductCategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::get();

        return ProductCategoryResource::collection($categories);
    }
}
