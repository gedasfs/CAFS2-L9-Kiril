<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $products = DB::select('select * from products where category_id < 10 and is_active = 1 order by id desc limit 3');

        $productsQuery = DB::table('products');

        if ($request->has('category_id')) {
            $productsQuery->where('category_id', $request->get('category_id'));
        }
        
        if ($request->has('active')) {
            $productsQuery->where('is_active', true);
        }

        if ($request->has('limit')) {
            // $productsQuery->limit($request->get('limit'));
            $productsQuery->take($request->get('limit'));
        }

        $productsQuery->orderBy('id', 'desc');

        // $productsQuery->select('id', 'name');

        $products = $productsQuery->get();

        // $products = Product::get();

        return view('products.index', compact('products'));
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

