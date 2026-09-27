<?php

namespace App\Http\Controllers;

use App\Models\UserLevel;
use App\Http\Requests\StoreUserLevelRequest;
use App\Http\Requests\UpdateUserLevelRequest;

class UserLevelController extends Controller
{
    public function index()
    {
        return UserLevel::with('employee')->get();
    }

    public function store(StoreUserLevelRequest $request)
    {
        $userLevel = UserLevel::create($request->validated());

        return response()->json($userLevel, 201);
    }

    public function show(UserLevel $userLevel)
    {
        return $userLevel->load('employee');
    }

    public function update(UpdateUserLevelRequest $request, UserLevel $userLevel)
    {
        $userLevel->update($request->validated());

        return response()->json($userLevel, 200);
    }

    public function destroy(UserLevel $userLevel)
    {
        $userLevel->delete();

        return response()->noContent();
    }
}