<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Http\Requests\StoreBuyRequest;
use App\Http\Requests\UpdateBuyRequest;
use App\Http\Resources\BuyResource;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = Buy::query();

    // Filtering
    $query->when($request->query('category'), function ($q, $category) {
        $q->where('category', $category);
    });

    $query->when($request->query('supplier_id'), function ($q, $supplierId) {
        $q->where('supplier_id', $supplierId);
    });

    $query->when($request->query('employee_id'), function ($q, $employeeId) {
        $q->where('employee_id', $employeeId);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where(function ($inner) use ($term) {
            $inner->where('product_name', 'like', "%{$term}%")
                  ->orWhere('category', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%");
        });
    });

    // Sorting - whitelist
    $sortable = [
        'product_name',
        'category',
        'quantity',
        'unitprice',
        'totalprice',
        'buy_date',
        'expire_date',
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

    return BuyResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuyRequest $request)
    {
        $buy = Buy::create($request->validated());

        return new BuyResource($buy);
    }

    /**
     * Display the specified resource.
     */
    public function show(Buy $buy)
    {
        return new BuyResource($buy);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateBuyRequest $request,
        Buy $buy
    ) {
        $buy->update($request->validated());

        return new BuyResource($buy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buy $buy)
    {
        $buy->delete();

        return response()->noContent();
    }
}