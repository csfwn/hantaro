<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Enums\PaymentStatus;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueChart extends ChartWidget
{
    public function getPollingInterval(): ?string
    {
        return '30s';
    }

    public function getHeading(): string
    {
        return 'Revenue & Orders (Last 12 Months)';
    }

    public function getDescription(): ?string
    {
        $totalRevenue = Order::where('payment_status', PaymentStatus::Success)
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->sum('paid_amount');
        
        $totalOrders = Order::where('payment_status', PaymentStatus::Success)
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->count();

        return 'Total: RM ' . number_format($totalRevenue, 2) . ' | ' . number_format($totalOrders) . ' Orders';
    }

    protected function getData(): array
    {
        $labels = [];
        $revenueData = [];
        $ordersData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);

            $labels[] = $date->format('M Y');

            $monthRevenue = Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('payment_status', PaymentStatus::Success)
                ->sum('paid_amount');

            $monthOrders = Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('payment_status', PaymentStatus::Success)
                ->count();

            $revenueData[] = $monthRevenue;
            $ordersData[] = $monthOrders;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (RM)',
                    'data' => $revenueData,
                    'borderColor' => '#22c55e',
                    'backgroundColor' => 'transparent',
                    'tension' => 0.4,
                    'borderWidth' => 2,
                    'pointBackgroundColor' => '#22c55e',
                    'pointBorderColor' => '#fff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                ],
                [
                    'label' => 'Successful Orders',
                    'data' => $ordersData,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'transparent',
                    'tension' => 0.4,
                    'borderWidth' => 2,
                    'pointBackgroundColor' => '#3b82f6',
                    'pointBorderColor' => '#fff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}