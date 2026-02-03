<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Enums\PaymentStatus;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends StatsOverviewWidget
{
    public function getPollingInterval(): ?string
    {
        return '15s';
    }

    protected function getStats(): array
    {
        // This month's data
        $thisMonthOrders = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        $thisMonthSuccess = Order::where('payment_status', PaymentStatus::Success)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        $thisMonthRevenue = Order::where('payment_status', PaymentStatus::Success)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('paid_amount');
        
        // Last month's data for comparison
        $lastMonthOrders = Order::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        
        $lastMonthSuccess = Order::where('payment_status', PaymentStatus::Success)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        
        $lastMonthRevenue = Order::where('payment_status', PaymentStatus::Success)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('paid_amount');
        
        // Calculate trends
        $ordersTrend = $lastMonthOrders > 0 
            ? round((($thisMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100, 1)
            : ($thisMonthOrders > 0 ? 100 : 0);
        
        $successTrend = $lastMonthSuccess > 0 
            ? round((($thisMonthSuccess - $lastMonthSuccess) / $lastMonthSuccess) * 100, 1)
            : ($thisMonthSuccess > 0 ? 100 : 0);
        
        $revenueTrend = $lastMonthRevenue > 0 
            ? round((($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : ($thisMonthRevenue > 0 ? 100 : 0);
        
        // Get daily data for this month's chart
        $daysInMonth = now()->daysInMonth;
        $dailyOrders = collect(range(1, min($daysInMonth, now()->day)))->map(function ($day) {
            return Order::whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->whereDay('created_at', $day)
                ->count();
        })->toArray();
        
        $dailySuccess = collect(range(1, min($daysInMonth, now()->day)))->map(function ($day) {
            return Order::where('payment_status', PaymentStatus::Success)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->whereDay('created_at', $day)
                ->count();
        })->toArray();
        
        $dailyRevenue = collect(range(1, min($daysInMonth, now()->day)))->map(function ($day) {
            return Order::where('payment_status', PaymentStatus::Success)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->whereDay('created_at', $day)
                ->sum('paid_amount');
        })->toArray();
        
        $conversionRate = $thisMonthOrders > 0 
            ? round(($thisMonthSuccess / $thisMonthOrders) * 100, 1) 
            : 0;

        return [
            Stat::make('Total Orders This Month', number_format($thisMonthOrders))
                ->description(($ordersTrend >= 0 ? '+' : '') . $ordersTrend . '% from last month')
                ->descriptionIcon($ordersTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($ordersTrend >= 0 ? 'success' : 'danger')
                ->chart($dailyOrders)
                ->icon('heroicon-o-shopping-bag')
                ->url(route('filament.admin.resources.orders.index')),

            Stat::make('Successful Orders This Month', number_format($thisMonthSuccess))
                ->description("{$conversionRate}% conversion rate")
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart($dailySuccess)
                ->icon('heroicon-o-check-badge')
                ->url(route('filament.admin.resources.orders.index', [
                    'filters[payment_status][value]' => PaymentStatus::Success->value,
                ])),
                
            Stat::make('Total Revenue This Month', 'RM ' . number_format($thisMonthRevenue, 2))
                ->description(($revenueTrend >= 0 ? '+' : '') . $revenueTrend . '% from last month')
                ->descriptionIcon($revenueTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($revenueTrend >= 0 ? 'success' : 'danger')
                ->chart($dailyRevenue)
                ->icon('heroicon-o-banknotes'),
        ];
    }
}