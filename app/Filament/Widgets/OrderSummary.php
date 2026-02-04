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

    // Public Livewire properties — these re-render on every poll
    public array $orders = [];
    public int $total = 0;
    public $user;

    public function mount(): void
    {
        $this->refreshData();
    }

    // Livewire calls this every polling cycle
    public function refreshData(): void
    {
        $this->user = auth()->user();
        $now = Carbon::now();

        $completed = Order::visibleTo($this->user)->where('status', OrderStatus::Completed->value)
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();

        $processing = Order::visibleTo($this->user)->where('status', OrderStatus::Processing->value)
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();

        $delivering = Order::visibleTo($this->user)->where('status', OrderStatus::Delivering->value)
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();

        $max = max($completed, $processing, $delivering, 1);

        $this->orders = [
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

        $this->total = $completed + $processing + $delivering;
    }
}