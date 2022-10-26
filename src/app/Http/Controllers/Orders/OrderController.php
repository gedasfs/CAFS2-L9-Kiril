<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\Orders\SaveOrderRequest;

class OrderController extends Controller
{
    public function index()
    {

        // https://laravel.com/docs/9.x/eloquent-relationships#eager-loading
        $orders = Order::with('user')->latest()->get();

        // Todo: refactor //
        $products = Product::get();
        $users = User::get();

        // return view('orders.index', compact('orders', 'products', 'users'));
        return response()->view('orders.index', compact('orders', 'products', 'users'));
    }

    public function save(SaveOrderRequest $request)
    {
        $order = new Order();

        $order->user_id = $request->get('user_id');

        $order->save();

        return response()->json();
    }
}
