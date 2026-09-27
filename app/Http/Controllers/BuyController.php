<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Http\Requests\StoreBuyRequest;
use App\Http\Requests\UpdateBuyRequest;

class BuyController extends Controller
{
    public function index()
    {
        $buys = Buy::with(['product', 'supplier', 'employee'])
            ->latest('buy_date')
            ->paginate(15);

        return response()->json($buys);
    }

    public function store(StoreBuyRequest $request)
    {
        $buy = Buy::create($request->validated());

        return response()->json($buy, 201);
    }

    public function show(Buy $buy)
    {
        return response()->json($buy);
    }

    public function update(UpdateBuyRequest $request, Buy $buy)
    {
        $buy->update($request->validated());

        return response()->json($buy);
    }

    public function destroy(Buy $buy)
    {
        $buy->delete();

        return response()->noContent();
    }
}