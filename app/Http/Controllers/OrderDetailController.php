<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\UpdateOrderDetailRequest;
use App\Http\Resources\OrderDetailResource;
use Illuminate\Http\Request;
class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = OrderDetail::query();

    // Filtering
    $query->when($request->query('order_id'), function ($q, $orderId) {
        $q->where('order_id', $orderId);
    });

    $query->when($request->query('product_id'), function ($q, $productId) {
        $q->where('product_id', $productId);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where(function ($inner) use ($term) {
            $inner->where('order_id', 'like', "%{$term}%")
                  ->orWhere('product_id', 'like', "%{$term}%");
        });
    });

    // Sorting - whitelist
    $sortable = [
        'order_id',
        'product_id',
        'quantity',
        'unitprice',
        'totalprice',
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

    return OrderDetailResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderDetailRequest $request)
    {
        $orderDetail = OrderDetail::create($request->validated());

        return new OrderDetailResource($orderDetail);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetail $orderDetail)
    {
        return new OrderDetailResource($orderDetail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateOrderDetailRequest $request,
        OrderDetail $orderDetail
    ) {
        $orderDetail->update($request->validated());

        return new OrderDetailResource($orderDetail);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();

        return response()->noContent();
    }
}