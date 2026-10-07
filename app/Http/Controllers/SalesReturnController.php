<?php

namespace App\Http\Controllers;

use App\Models\SalesReturn;
use App\Http\Requests\StoreSalesReturnRequest;
use App\Http\Requests\UpdateSalesReturnRequest;
use App\Http\Resources\SalesReturnResource;
use Illuminate\Http\Request;
class SalesReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = SalesReturn::query();

    // Filtering
    $query->when($request->query('product_id'), function ($q, $productId) {
        $q->where('product_id', $productId);
    });

    $query->when($request->query('return_date'), function ($q, $returnDate) {
        $q->whereDate('return_date', $returnDate);
    });

    $query->when($request->query('reason'), function ($q, $reason) {
        $q->where('reason', $reason);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where('reason', 'like', "%{$term}%");
    });

    // Sorting - whitelist
    $sortable = [
        'product_id',
        'return_date',
        'reason',
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

    return SalesReturnResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesReturnRequest $request)
    {
        $salesReturn = SalesReturn::create($request->validated());

        return new SalesReturnResource($salesReturn);
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesReturn $salesReturn)
    {
        return new SalesReturnResource($salesReturn);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateSalesReturnRequest $request,
        SalesReturn $salesReturn
    ) {
        $salesReturn->update($request->validated());

        return new SalesReturnResource($salesReturn);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesReturn $salesReturn)
    {
        $salesReturn->delete();

        return response()->noContent();
    }
}