<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('employee')
            ->latest('sale_date')
            ->paginate(15);

        return response()->json($sales);
    }

    public function store(StoreSaleRequest $request)
    {
        $sale = Sale::create($request->validated());

        return response()->json($sale, 201);
    }

    public function show(Sale $sale)
    {
        return response()->json($sale);
    }

    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        $sale->update($request->validated());

        return response()->json($sale);
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return response()->noContent();
    }
}