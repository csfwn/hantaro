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
        return [
            Stat::make('Total Orders', Order::count())
                ->icon('heroicon-m-shopping-bag')
                ->url(route('filament.admin.resources.orders.index')),

            Stat::make(
                'Paid Orders',
                Order::where('payment_status', PaymentStatus::Success)->count()
            )
                ->color('success')
                ->icon('heroicon-m-check')
                ->url(route('filament.admin.resources.orders.index', [
                    'filters[payment_status][value]' => PaymentStatus::Success->value,
                ])),


            Stat::make(
                'Total Revenue',
                'RM ' . number_format(
                    Order::where('payment_status', PaymentStatus::Success)
                        ->sum('paid_amount'),
                    2
                )
            )
                ->color('success')
                ->icon('heroicon-m-banknotes'),
        ];
    }
}
