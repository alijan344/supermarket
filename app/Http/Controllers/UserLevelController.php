<?php

namespace App\Http\Controllers;

use App\Models\UserLevel;
use App\Http\Requests\StoreUserLevelRequest;
use App\Http\Requests\UpdateUserLevelRequest;
use App\Http\Resources\UserLevelResource;
use Illuminate\Http\Request;
class UserLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = UserLevel::query();

    // Filtering
    $query->when($request->query('employee_id'), function ($q, $employeeId) {
        $q->where('employee_id', $employeeId);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where('employee_id', 'like', "%{$term}%");
    });

    // Sorting - whitelist
    $sortable = [
        'employee_id',
        'head',
        'hr',
        'inventory',
        'finance',
    ];

    $sort = $request->query('sort', 'employee_id');
    $direction = $request->query('direction', 'asc');

    if (!in_array($sort, $sortable)) {
        $sort = 'employee_id';
    }

    if (!in_array($direction, ['asc', 'desc'])) {
        $direction = 'asc';
    }

    $query->orderBy($sort, $direction);

    // Pagination
    $perPage = (int) $request->query('per_page', 15);
    $perPage = min(100, max(1, $perPage));

    return UserLevelResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserLevelRequest $request)
    {
        $userLevel = UserLevel::create($request->validated());

        return new UserLevelResource($userLevel);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserLevel $userLevel)
    {
        return new UserLevelResource($userLevel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateUserLevelRequest $request,
        UserLevel $userLevel
    ) {
        $userLevel->update($request->validated());

        return new UserLevelResource($userLevel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserLevel $userLevel)
    {
        $userLevel->delete();

        return response()->noContent();
    }
}