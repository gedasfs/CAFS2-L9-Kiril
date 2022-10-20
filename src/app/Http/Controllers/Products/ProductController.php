<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    const ORDERING_VALUES = [
        'created_at' => 'Newest first',
        'name:asc'   => 'Name Accessing',
        'name:desc'  => 'Name Descending',
        'price:asc'  => 'Price Accessing',
        'price:desc' => 'Price Descending',
        'identifier:asc' => 'Identifier Accessing',
        'identifier:desc' => 'Identifier Descending',
    ];

    const ORDERING_DEFAULT_VALUE = 'created_at';

    public function index(Request $request)
    {
        $productQuery = Product::query()->where('is_active', true);

        $categoryId = $request->get('category_id');

        if ($categoryId && is_numeric($categoryId)) {
            $productQuery->where('category_id', $categoryId);
        }

        if ($request->has('search')) {
            $likeValue = '%' . $request->get('search') . '%';

            $productQuery->where(function($query) use($likeValue) {
                $query->where('name', 'LIKE', $likeValue);
                $query->orWhere('description', 'LIKE', $likeValue);
            });
        }

        $orderBy = $request->get('order_by');
        $orderBy = array_key_exists($orderBy, self::ORDERING_VALUES) ? $orderBy : self::ORDERING_DEFAULT_VALUE;
        $orderBy = explode(':', $orderBy);

        $orderByColumn = $orderBy[0];
        $orderByDirection = $orderBy[1] ?? 'desc';

        $productQuery->orderBy($orderByColumn, $orderByDirection);

        $products = $productQuery->get();

        // Categories moved to view composer
        // $categories = ProductCategory::get();
        // $view = view('products.index', compact('products', 'categories'));

        $view = view('products.index', compact('products'));

        $view->with('categoryId', $request->get('category_id'));
        $view->with('ordering', self::ORDERING_VALUES);

        return $view;
    }
    
    public function create()
    {   
        // Categories moved to view composer
        // $categories = ProductCategory::get();
        // return view('products.create', compact('categories'));

        return view('products.create');
    }

    public function storeV1(Request $request)
    {
        // https://laravel.com/docs/9.x/eloquent#mass-assignment
        $product = Product::create($request->all());
        // $product = Product::create($request->only('name', 'description', 'category_id', 'identifier'));
        
        return redirect()->route('products.show', $product->id);
    }

    public function storeV2(Request $request)
    {
        $product = new Product();

        $product->name        = $request->get('name');
        $product->description = $request->get('description');
        $product->category_id = $request->get('category_id');
        $product->identifier  = $request->get('identifier');

        $product->is_active = true;

        $product->save();
        
        return redirect()->route('products.show', $product->id);
    }

    public function storeV3(Request $request)
    {
        // $product = new Product($request->all());
        $product = new Product($request->only('name', 'description', 'category_id', 'identifier'));

        $product->is_active = true;

        $product->save();

        return redirect()->route('products.show', $product->id);
    }

    // https://laravel.com/docs/9.x/validation#quick-writing-the-validation-logic
    public function storeV4(Request $request)
    {
        // https://laravel.com/docs/9.x/validation#validating-arrays
        $rules = [
            'name' => 'required|min:5|max:255|string',
            'description' => ['required', 'min:5', 'max:1000', 'string'],
            'category_id' => ['required', sprintf('exists:%s,id', ProductCategory::class)],

            // 'identifier' => ['required', 'unique:products,identifier'],
            // 'identifier' => ['required', 'unique:App\Models\Product,identifier'],
            'identifier' => ['required', sprintf('unique:%s,identifier', Product::class)]
        ];

        $validated = $request->validate($rules);

        // $product = new Product($validated);
        // $product->is_active = true;
        // $product->save();

        return $this->storeV3($request);
    }

    public function edit(Product $product)
    {    
        return view('products.edit');
    }

    public function show(Product $product)
    {   
        return view('products.show', compact('product'));
    }
}

