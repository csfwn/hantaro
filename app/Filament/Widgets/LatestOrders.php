<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestOrders extends TableWidget
{
    public function getPollingInterval(): ?string
    {
        return '10s';
    }

    protected function getTableQuery(): Builder
    {
        return Order::latest()->limit(5);
    }

    public function getTableDescription(): ?string
    {
        return 'Latest 5 orders today';
    }

    public function isTableSearchable(): bool
    {
        return false;
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('ref_no')
                ->label('Order No'),

            Tables\Columns\TextColumn::make('store.name')
                ->label('Store'),

            Tables\Columns\TextColumn::make('total_amount')
                ->money('MYR'),

            Tables\Columns\TextColumn::make('payment_status')
                ->badge(),
                
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created At'),
        ];
    }
}
