<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('subscriber')
            ->latest('order_date')
            ->paginate(15);

        return response()->json($orders);
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());

        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        return response()->json($order);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->noContent();
    }
}