<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use App\Models\ServiceStatus;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function metrics(): JsonResponse
    {
        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();

        $dailyTransactions = Transaction::whereDate('created_at', $today)->count();
        $yesterdayTransactions = Transaction::whereDate('created_at', $yesterday)->count();
        $transactionChange = $yesterdayTransactions ? round(($dailyTransactions - $yesterdayTransactions) / $yesterdayTransactions * 100, 1) : 0;

        $dailyRevenue = Transaction::whereDate('created_at', $today)->sum('amount');
        $yesterdayRevenue = Transaction::whereDate('created_at', $yesterday)->sum('amount');
        $revenueChange = $yesterdayRevenue ? round(($dailyRevenue - $yesterdayRevenue) / $yesterdayRevenue * 100, 1) : 0;

        $activeProducts = Product::where('is_active', true)->count();
        $newProducts = Product::whereDate('created_at', $today)->count();

        $activeUsers = User::where('last_active_at', '>=', now()->subDays(7))->count();
        $userChange = 8.1; // simplified for demo

        return response()->json([
            'daily_transactions' => number_format($dailyTransactions),
            'transaction_change' => ($transactionChange >= 0 ? '+' : '') . $transactionChange . '% from yesterday',
            'revenue_today' => '$' . number_format($dailyRevenue, 2),
            'revenue_change' => ($revenueChange >= 0 ? '+' : '') . $revenueChange . '% from yesterday',
            'active_products' => number_format($activeProducts),
            'product_change' => '+' . $newProducts . ' new products',
            'active_users' => number_format($activeUsers),
            'user_change' => '+' . $userChange . '% from last week',
        ]);
    }

    public function transactionChart(): JsonResponse
    {
        $data = [];
        for ($i = 0; $i < 24; $i += 4) {
            $time = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
            $transactions = Transaction::whereBetween('created_at', [now()->setTime($i, 0), now()->setTime($i + 3, 59)])->count();
            $revenue = Transaction::whereBetween('created_at', [now()->setTime($i, 0), now()->setTime($i + 3, 59)])->sum('amount');
            $data[] = ['time' => $time, 'transactions' => $transactions, 'revenue' => $revenue];
        }
        return response()->json($data);
    }

    public function serviceStatus(): JsonResponse
    {
        $services = ServiceStatus::all()->map(function ($service) {
            return [
                'name' => $service->service_name,
                'status' => $service->status,
                'response' => $service->response_time_ms . 'ms',
            ];
        });
        return response()->json($services);
    }

    public function recentActivity(): JsonResponse
    {
        $activities = Activity::latest()->take(5)->get()->map(function ($activity) {
            return [
                'id' => $activity->id,
                'type' => $activity->type,
                'message' => $activity->message,
                'timestamp' => $activity->created_at->diffForHumans(),
                'status' => $activity->status,
            ];
        });
        return response()->json($activities);
    }

    public function additionalMetrics(): JsonResponse
    {
        $avgResponse = ServiceStatus::avg('response_time_ms');
        $uptime = 99.97; // simulated
        return response()->json([
            'avg_response_time' => round($avgResponse) . 'ms',
            'response_change' => '-23ms from yesterday',
            'system_uptime' => $uptime . '%',
            'uptime_change' => '30 days running',
        ]);
    }
}