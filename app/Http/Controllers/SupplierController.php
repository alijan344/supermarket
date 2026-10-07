<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use Illuminate\Http\Request;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Supplier::query();

    // Filtering
    $query->when($request->query('supplier_type'), function ($q, $supplierType) {
        $q->where('supplier_type', $supplierType);
    });

    $query->when($request->query('location'), function ($q, $location) {
        $q->where('location', $location);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where(function ($inner) use ($term) {
            $inner->where('name', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%")
                  ->orWhere('phone', 'like', "%{$term}%")
                  ->orWhere('location', 'like', "%{$term}%");
        });
    });

    // Sorting - whitelist
    $sortable = [
        'name',
        'supplier_type',
        'location',
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

    return SupplierResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());

        return new SupplierResource($supplier);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return new SupplierResource($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateSupplierRequest $request,
        Supplier $supplier
    ) {
        $supplier->update($request->validated());

        return new SupplierResource($supplier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->noContent();
    }
}