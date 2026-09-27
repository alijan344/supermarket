<?php

namespace App\Http\Controllers;

use App\Models\SalesDetail;
use App\Http\Requests\StoreSalesDetailRequest;
use App\Http\Requests\UpdateSalesDetailRequest;

class SalesDetailController extends Controller
{
    public function index()
    {
        $salesDetails = SalesDetail::with(['sale', 'product'])->get();

        return response()->json($salesDetails);
    }

    public function store(StoreSalesDetailRequest $request)
    {
        $salesDetail = SalesDetail::create($request->validated());

        return response()->json([
            'message' => 'Sales detail created successfully',
            'data' => $salesDetail
        ], 201);
    }

    public function show(SalesDetail $salesDetail)
    {
        $salesDetail->load(['sale', 'product']);

        return response()->json($salesDetail);
    }

    public function update(
        UpdateSalesDetailRequest $request,
        SalesDetail $salesDetail
    ) {
        $salesDetail->update($request->validated());

        return response()->json([
            'message' => 'Sales detail updated successfully',
            'data' => $salesDetail
        ]);
    }

    public function destroy(SalesDetail $salesDetail)
    {
        $salesDetail->delete();

        return response()->json([
            'message' => 'Sales detail deleted successfully'
        ]);
    }
}