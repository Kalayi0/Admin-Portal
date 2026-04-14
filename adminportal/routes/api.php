<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard/metrics', [DashboardController::class, 'metrics']);
    Route::get('/dashboard/chart', [DashboardController::class, 'transactionChart']);
    Route::get('/dashboard/services', [DashboardController::class, 'serviceStatus']);
    Route::get('/dashboard/activities', [DashboardController::class, 'recentActivity']);
    Route::get('/dashboard/additional', [DashboardController::class, 'additionalMetrics']);
});