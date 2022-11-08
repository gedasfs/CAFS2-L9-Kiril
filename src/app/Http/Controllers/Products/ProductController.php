<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    function __construct(private ProductService $productService)
    {
    }

    public function index(Request $request)
    {
        $products = $this->productService->get($request->only('category_id', 'search', 'order_by'));

        // Categories moved to view composer
        // $categories = ProductCategory::get();
        // $view = view('products.index', compact('products', 'categories'));

        $view = view('products.index', compact('products'));

        $view->with('categoryId', $request->get('category_id'));
        $view->with('ordering', ProductService::ORDERING_VALUES);

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

        // // https://en.wikipedia.org/wiki/Don%27t_repeat_yourself
        // $product = new Product($validated);
        // $product->is_active = true;
        // $product->save();

        return $this->storeV3($request);
    }

    public function storeV5(StoreProductRequest $request)
    {
        return $this->storeV3($request);
    }

    public function edit(Product $product)
    {    
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {    
        $product->fill($request->validated());

        $product->save();

        return redirect()->route('products.show', $product->id);
    }

    public function show(Product $product)
    {   
        return view('products.show', compact('product'));
    }
}

