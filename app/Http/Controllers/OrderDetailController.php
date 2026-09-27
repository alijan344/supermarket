<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\UpdateOrderDetailRequest;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::with(['order', 'product'])
            ->latest('order_id')
            ->paginate(15);

        return response()->json($orderDetails);
    }

    public function store(StoreOrderDetailRequest $request)
    {
        $orderDetail = OrderDetail::create($request->validated());

        return response()->json($orderDetail, 201);
    }

    public function show(OrderDetail $orderDetail)
    {
        return response()->json($orderDetail);
    }

    public function update(UpdateOrderDetailRequest $request, OrderDetail $orderDetail)
    {
        $orderDetail->update($request->validated());

        return response()->json($orderDetail);
    }

    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();

        return response()->noContent();
    }
}