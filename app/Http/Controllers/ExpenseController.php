<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = Expense::query();

    // Filtering
    $query->when($request->query('currency'), function ($q, $currency) {
        $q->where('currency', $currency);
    });

    $query->when($request->query('employee_id'), function ($q, $employeeId) {
        $q->where('employee_id', $employeeId);
    });

    $query->when($request->query('pay_date'), function ($q, $payDate) {
        $q->whereDate('pay_date', $payDate);
    });

    // Searching
    $query->when($request->query('search'), function ($q, $term) {
        $q->where(function ($inner) use ($term) {
            $inner->where('title', 'like', "%{$term}%")
                  ->orWhere('receiver', 'like', "%{$term}%")
                  ->orWhere('currency', 'like', "%{$term}%");
        });
    });

    // Sorting - whitelist
    $sortable = [
        'title',
        'amount',
        'currency',
        'pay_date',
        'employee_id',
        'receiver',
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

    return ExpenseResource::collection(
        $query->paginate($perPage)
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->validated());

        return new ExpenseResource($expense);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return new ExpenseResource($expense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateExpenseRequest $request,
        Expense $expense
    ) {
        $expense->update($request->validated());

        return new ExpenseResource($expense);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return response()->noContent();
    }
}