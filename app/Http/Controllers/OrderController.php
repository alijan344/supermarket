<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Order::query();

    // Filtering
    $query->when($request->query('subscriber_id'), function ($q, $subscriberId) {
        $q->where('subscriber_id', $subscriberId);
    });

    $query->when($request->query('order_date'), function ($q, $orderDate) {
        $q->whereDate('order_date', $orderDate);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where(function ($inner) use ($term) {
            $inner->where('order_id', 'like', "%{$term}%")
                  ->orWhere('subscriber_id', 'like', "%{$term}%");
        });
    });

    // Sorting - whitelist
    $sortable = [
        'order_id',
        'subscriber_id',
        'order_date',
        'created_at',
    ];

    $sort = $request->query('sort', 'created_at');
    $direction = $request->query('direction', 'desc');

    if (!in_array($sort, $sortable)) {
        $sort = 'created_at';
    }

    if (!in_array($direction, ['asc', 'desc'])) {
        $direction = 'desc';
    }

    $query->orderBy($sort, $direction);

    // Pagination
    $perPage = (int) $request->query('per_page', 15);
    $perPage = min(100, max(1, $perPage));

    return OrderResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateOrderRequest $request,
        Order $order
    ) {
        $order->update($request->validated());

        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->noContent();
    }
}