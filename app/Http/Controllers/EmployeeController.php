<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = Employee::query();

    // Filtering
    $query->when($request->query('position'), function ($q, $position) {
        $q->where('position', $position);
    });

    $query->when($request->query('gender'), function ($q, $gender) {
        $q->where('gender', $gender);
    });

    $query->when($request->query('marital_status'), function ($q, $status) {
        $q->where('marital_status', $status);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where(function ($inner) use ($term) {
            $inner->where('firstname', 'like', "%{$term}%")
                  ->orWhere('lastname', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%")
                  ->orWhere('phone', 'like', "%{$term}%");
        });
    });

    // Sorting - whitelist
    $sortable = [
        'firstname',
        'lastname',
        'position',
        'salary',
        'hire_date',
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

    return EmployeeResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        return new EmployeeResource($employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateEmployeeRequest $request,
        Employee $employee
    ) {
        $employee->update($request->validated());

        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->noContent();
    }
}