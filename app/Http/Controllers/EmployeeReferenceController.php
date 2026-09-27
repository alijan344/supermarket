<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeReferenceRequest;
use App\Http\Requests\UpdateEmployeeReferenceRequest;
use App\Models\EmployeeReference;
use Illuminate\Http\JsonResponse;

class EmployeeReferenceController extends Controller
{
    public function index(): JsonResponse
    {
        $references = EmployeeReference::with('employee')
            ->latest('reference_id')
            ->paginate(15);

        return response()->json($references);
    }

    public function store(StoreEmployeeReferenceRequest $request): JsonResponse
    {
        $reference = EmployeeReference::create($request->validated());

        return response()->json($reference, 201);
    }

    public function show(EmployeeReference $employeeReference): JsonResponse
    {
        return response()->json(
            $employeeReference->load('employee')
        );
    }

    public function update(
        UpdateEmployeeReferenceRequest $request,
        EmployeeReference $employeeReference
    ): JsonResponse {
        $employeeReference->update($request->validated());

        return response()->json(
            $employeeReference->fresh()->load('employee')
        );
    }

    public function destroy(EmployeeReference $employeeReference)
    {
        $employeeReference->delete();

        return response()->noContent();
    }
}