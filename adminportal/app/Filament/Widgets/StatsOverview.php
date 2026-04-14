<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Revenue', '$' . number_format(Transaction::sum('amount'), 2))
                ->description('All time')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
            Stat::make('Transactions', Transaction::count())
                ->description('Today: ' . Transaction::whereDate('created_at', today())->count())
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),
            Stat::make('Products', Product::count())
                ->description('Active: ' . Product::where('is_active', true)->count())
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning'),
            Stat::make('Customers', User::where('role', 'customer')->count())
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
}