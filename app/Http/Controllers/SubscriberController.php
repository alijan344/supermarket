<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Http\Resources\SubscriberResource;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Subscriber::query();

    // Filtering
    $query->when($request->query('gender'), function ($q, $gender) {
        $q->where('gender', $gender);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where(function ($inner) use ($term) {
            $inner->where('subscriber_name', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%")
                  ->orWhere('phone', 'like', "%{$term}%");
        });
    });

    // Sorting - whitelist
    $sortable = [
        'subscriber_name',
        'dob',
        'gender',
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

    return SubscriberResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriberRequest $request)
    {
        $subscriber = Subscriber::create($request->validated());

        return new SubscriberResource($subscriber);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscriber $subscriber)
    {
        return new SubscriberResource($subscriber);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateSubscriberRequest $request,
        Subscriber $subscriber
    ) {
        $subscriber->update($request->validated());

        return new SubscriberResource($subscriber);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return response()->noContent();
    }
}