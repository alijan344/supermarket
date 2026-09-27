<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;

class SubscriberController extends Controller
{
    public function index(): JsonResponse
    {
        $subscribers = Subscriber::latest('subscriber_id')->get();

        return response()->json([
            'success' => true,
            'data' => $subscribers,
        ]);
    }

    public function store(StoreSubscriberRequest $request): JsonResponse
    {
        $subscriber = Subscriber::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Subscriber created successfully.',
            'data' => $subscriber,
        ], 201);
    }

    public function show(Subscriber $subscriber): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $subscriber,
        ]);
    }

    public function update(
        UpdateSubscriberRequest $request,
        Subscriber $subscriber
    ): JsonResponse {
        $subscriber->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Subscriber updated successfully.',
            'data' => $subscriber->fresh(),
        ]);
    }

    public function destroy(Subscriber $subscriber): JsonResponse
    {
        $subscriber->delete();

        return response()->json([
            'success' => true,
            'message' => 'Subscriber deleted successfully.',
        ]);
    }
}