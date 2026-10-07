<?php

namespace App\Http\Controllers;

use App\Models\EmployeeReference;
use App\Http\Requests\StoreEmployeeReferenceRequest;
use App\Http\Requests\UpdateEmployeeReferenceRequest;
use App\Http\Resources\EmployeeReferenceResource;
use Illuminate\Http\Request;

class EmployeeReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = EmployeeReference::query();

    // Filtering
    $query->when($request->query('employee_id'), function ($q, $employeeId) {
        $q->where('employee_id', $employeeId);
    });

    $query->when($request->query('organization'), function ($q, $organization) {
        $q->where('organization', $organization);
    });

    $query->when($request->query('position'), function ($q, $position) {
        $q->where('position', $position);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where(function ($inner) use ($term) {
            $inner->where('reference_name', 'like', "%{$term}%")
                  ->orWhere('organization', 'like', "%{$term}%")
                  ->orWhere('phone', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%");
        });
    });

    // Sorting - whitelist
    $sortable = [
        'reference_name',
        'organization',
        'position',
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

    return EmployeeReferenceResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeReferenceRequest $request)
    {
        $employeeReference = EmployeeReference::create(
            $request->validated()
        );

        return new EmployeeReferenceResource($employeeReference);
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeReference $employeeReference)
    {
        return new EmployeeReferenceResource($employeeReference);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateEmployeeReferenceRequest $request,
        EmployeeReference $employeeReference
    ) {
        $employeeReference->update($request->validated());

        return new EmployeeReferenceResource($employeeReference);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeReference $employeeReference)
    {
        $employeeReference->delete();

        return response()->noContent();
    }
}