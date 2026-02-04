<?php

namespace App\Filament\Resources\Products\Tables;

use App\Enums\ActiveStatus;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        $currency = config('params.currency_symbol');

        return $table
            ->poll('3s')
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('sku')
                    ->label('SKU')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('store.name')
                    ->label('Store')
                    ->sortable(),

                TextColumn::make('stock')
                    ->label('Stock')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Price')
                    ->prefix($currency)
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->alignCenter(),

                ToggleColumn::make('is_active')
                    ->label(__('Status'))
                    ->alignCenter()
                    ->onColor('success'),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->alignCenter()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Status'),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ], position: RecordActionsPosition::BeforeColumns)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
