<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\Orders\SaveOrderRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Orders\OrderResource;
use App\Http\Resources\Products\ProductResource;

class OrderController extends Controller
{
    public function index()
    {
        // https://laravel.com/docs/9.x/eloquent-relationships#eager-loading
        $orders = Order::with('user', 'products')->latest()->get();

        // Todo: refactor //
        $products = Product::get();
        $users = User::get();

        // return view('orders.index', compact('orders', 'products', 'users'));
        return response()->view('orders.index', compact('orders', 'products', 'users'));
    }

    public function saveV1(SaveOrderRequest $request)
    {
        $order = new Order();

        $order->user_id = $request->get('user_id');

        $order->save();

        foreach ($request->get('products') as $productData) {
            DB::insert('INSERT INTO `orders_products` (`order_id`, `product_id`, `count`) VALUES (?, ?, ?)', [
                $order->id,
                $productData['id'],
                $productData['count']
            ]);
        }

        return response()->json();
    }

    public function saveV2(SaveOrderRequest $request, Order $order = null)
    {
        $user = User::find($request->get('user_id'));

        if ($order == null) {
            $order = new Order();
        }

        // https://laravel.com/docs/9.x/eloquent-relationships#updating-belongs-to-relationships
        $order->user()->associate($user);

        $order->save();

        $products = [];

        foreach ($request->get('products') as $productData) {
            $products[$productData['id']] = [
                'count' => $productData['count'],
                // 'data'  => new ProductResource(Product::find($productData['id']))
                'data'  => Product::with('category')->find($productData['id'])->toJson()
            ];
        }

        // https://laravel.com/docs/9.x/eloquent-relationships#syncing-associations
        $order->products()->sync($products);

        return response()->json();
    }

    public function edit(Order $order)
    {
        return new OrderResource($order);
    }
}
