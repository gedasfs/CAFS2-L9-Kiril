<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('products.index', [
            'products' => $products
        ]);
    }
    
    public function create()
    {    
        return view('products.create');
    }

    public function edit()
    {    
        return view('products.edit');
    }

    public function show()
    {    
        return view('products.show');
    }
}
