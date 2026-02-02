<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestOrders;
use App\Filament\Widgets\OrderStats;
use App\Filament\Widgets\RevenueChart;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    // ❌ Remove default header widgets
    protected function getHeaderWidgets(): array
    {
        return [];
    }

    // ✅ MUST be public in Filament v4
    public function getWidgets(): array
    {
        return [
            OrderStats::class,
            RevenueChart::class,
            LatestOrders::class,   
        ];
    }
}
