<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = User::query();

    // Filtering
    $query->when($request->query('employee_id'), function ($q, $employeeId) {
        $q->where('employee_id', $employeeId);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where('username', 'like', "%{$term}%");
    });

    // Sorting - whitelist
    $sortable = [
        'employee_id',
        'username',
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

    return UserResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateUserRequest $request,
        User $user
    ) {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}