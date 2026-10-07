<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Http\Resources\SalesResource;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = Sale::query();

    // Filtering
    $query->when($request->query('employee_id'), function ($q, $employeeId) {
        $q->where('employee_id', $employeeId);
    });

    $query->when($request->query('sale_date'), function ($q, $saleDate) {
        $q->whereDate('sale_date', $saleDate);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where(function ($inner) use ($term) {
            $inner->where('sale_id', 'like', "%{$term}%")
                  ->orWhere('employee_id', 'like', "%{$term}%");
        });
    });

    // Sorting - whitelist
    $sortable = [
        'sale_id',
        'employee_id',
        'sale_date',
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

    return SalesResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $sale = Sale::create($request->validated());

        return new SalesResource($sale);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return new SalesResource($sale);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateSaleRequest $request,
        Sale $sale
    ) {
        $sale->update($request->validated());

        return new SalesResource($sale);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return response()->noContent();
    }
}