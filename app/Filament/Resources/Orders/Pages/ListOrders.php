<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Enums\OrderStatus;
use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All')
                ->badge(Order::count()),

            'processing' => Tab::make('Processing')
                ->badge(Order::where('status', OrderStatus::Processing->value)->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->where('status', OrderStatus::Processing->value)
                ),

            'delivering' => Tab::make('Delivering')
                ->badge(Order::where('status', OrderStatus::Delivering->value)->count())
                ->badgeColor('info')
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->where('status', OrderStatus::Delivering->value)
                ),

            'completed' => Tab::make('Completed')
                ->badge(Order::where('status', OrderStatus::Completed->value)->count())
                ->badgeColor('success')
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->where('status', OrderStatus::Completed->value)
                ),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'processing';
    }
}
