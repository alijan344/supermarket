<?php

namespace App\Http\Controllers;

use App\Models\SalesReturn;
use App\Http\Requests\StoreSalesReturnRequest;
use App\Http\Requests\UpdateSalesReturnRequest;

class SalesReturnController extends Controller
{
    public function index()
    {
        return SalesReturn::with('product')->get();
    }

    public function store(StoreSalesReturnRequest $request)
    {
        $salesReturn = SalesReturn::create($request->validated());

        return response()->json($salesReturn, 201);
    }

    public function show(SalesReturn $salesReturn)
    {
        return $salesReturn->load('product');
    }

    public function update(UpdateSalesReturnRequest $request, SalesReturn $salesReturn)
    {
        $salesReturn->update($request->validated());

        return response()->json($salesReturn, 200);
    }

    public function destroy(SalesReturn $salesReturn)
    {
        $salesReturn->delete();

        return response()->noContent();
    }
}