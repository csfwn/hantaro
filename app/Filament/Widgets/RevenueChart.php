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
        return 'Revenue (Last 7 Days)';
    }


    protected function getData(): array
    {
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $labels[] = $date->format('d M');

            $data[] = Order::whereDate('created_at', $date)
                ->where('payment_status', PaymentStatus::Success)
                ->sum('paid_amount');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data,
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
