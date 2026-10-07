<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeReferenceController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalesDetailController;
use App\Http\Controllers\SalesReturnController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLevelController;

Route::prefix('v1')->group(function () {

    // Public routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/me', function (Request $request) {
            return $request->user();
        });

        Route::apiResource('buys', BuyController::class);
        Route::apiResource('employees', EmployeeController::class);
        Route::apiResource('employee-references', EmployeeReferenceController::class);
        Route::apiResource('expenses', ExpenseController::class);
        Route::apiResource('orders', OrderController::class);
        Route::apiResource('order-details', OrderDetailController::class);
        Route::apiResource('products', ProductController::class);
        Route::apiResource('sales', SaleController::class);
        Route::apiResource('sales-details', SalesDetailController::class);
        Route::apiResource('sales-returns', SalesReturnController::class);
        Route::apiResource('subscribers', SubscriberController::class);
        Route::apiResource('suppliers', SupplierController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('user-levels', UserLevelController::class);
    });
});