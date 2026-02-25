<?php

namespace App\Filament\Resources\Stores\Tables;

use App\Enums\ActiveStatus;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Model;

class StoresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Owner')
                    ->limit(25)
                    ->tooltip(fn(Model $record) => $record->user?->name)
                    ->description(fn(Model $record) => $record->user?->email)
                    ->searchable()
                    ->visible(fn() => ! auth()->user()?->hasRole('merchant')),
                TextColumn::make('name')
                    ->label('Store Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('code')
                    ->label('Code')
                    ->copyable()
                    ->searchable(),
                TextColumn::make('store_url')
                    ->label('URL')
                    ->copyable(),
                TextColumn::make('contact_no')
                    ->label('Contact Number')
                    ->searchable(),
                TextColumn::make('status')->badge(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options(ActiveStatus::class),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ], position: RecordActionsPosition::BeforeColumns)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
