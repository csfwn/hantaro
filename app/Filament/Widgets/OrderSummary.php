<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatus;
use Filament\Widgets\Widget;
use App\Models\Order;
use Carbon\Carbon;

class OrderSummary extends Widget
{
    protected string $view = 'filament.widgets.order-summary';

    protected ?string $pollingInterval = '15s';

    public function getViewData(): array
    {
        $now = Carbon::now();

        $completed = Order::where('status', OrderStatus::Completed->value)
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();

        $processing = Order::where('status', OrderStatus::Processing->value)
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();

        $delivering = Order::where('status', OrderStatus::Delivering->value)
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();

        $max = max($completed, $processing, $delivering, 1);
        $total = $completed + $processing + $delivering;

        $orders = [
            [
                'label'      => 'Processing',
                'count'      => $processing,
                'percentage' => round(($processing / $max) * 100, 2),
            ],
            [
                'label'      => 'Delivering',
                'count'      => $delivering,
                'percentage' => round(($delivering / $max) * 100, 2),
            ],
            [
                'label'      => 'Completed',
                'count'      => $completed,
                'percentage' => round(($completed / $max) * 100, 2),
            ],
        ];

        return [
            'orders' => $orders,
            'total'  => $total,
        ];
    }
}