<?php

namespace App\Http\Controllers;

use App\Models\SalesDetail;
use App\Http\Requests\StoreSalesDetailRequest;
use App\Http\Requests\UpdateSalesDetailRequest;
use App\Http\Resources\SalesDetailResource;
use Illuminate\Http\Request;
class SalesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = SalesDetail::query();

    // Filtering
    $query->when($request->query('sale_id'), function ($q, $saleId) {
        $q->where('sale_id', $saleId);
    });

    $query->when($request->query('product_id'), function ($q, $productId) {
        $q->where('product_id', $productId);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where(function ($inner) use ($term) {
            $inner->where('sale_id', 'like', "%{$term}%")
                  ->orWhere('product_id', 'like', "%{$term}%");
        });
    });

    // Sorting - whitelist
    $sortable = [
        'sale_id',
        'product_id',
        'quantity',
        'unitprice',
        'totalprice',
        'discount',
        'totalamount',
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

    return SalesDetailResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesDetailRequest $request)
    {
        $salesDetail = SalesDetail::create($request->validated());

        return new SalesDetailResource($salesDetail);
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesDetail $salesDetail)
    {
        return new SalesDetailResource($salesDetail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateSalesDetailRequest $request,
        SalesDetail $salesDetail
    ) {
        $salesDetail->update($request->validated());

        return new SalesDetailResource($salesDetail);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesDetail $salesDetail)
    {
        $salesDetail->delete();

        return response()->noContent();
    }
}