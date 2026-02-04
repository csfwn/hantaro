<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Schemas\Components\Grid;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        $currency = config('params.currency_symbol');

        return $schema->components([
            Grid::make(12)
                ->schema([
                    Grid::make(1)
                        ->schema([
                            Section::make('Product Information')
                                ->columns(3)
                                ->schema([
                                    TextEntry::make('name')
                                        ->label('Product Name'),

                                    TextEntry::make('slug')
                                        ->label('Slug'),

                                    TextEntry::make('sku')
                                        ->label('SKU'),

                                    TextEntry::make('price')
                                        ->badge()
                                        ->label('Price')
                                        ->prefix($currency),

                                    TextEntry::make('stock')
                                        ->label('Stock'),

                                    TextEntry::make('is_active')
                                        ->label(__('Status'))
                                        ->badge()
                                        ->getStateUsing(fn($record) => $record->is_active ? 'Active' : 'Inactive')
                                        ->color(fn($record) => $record->is_active ? 'success' : 'danger'),

                                ])->collapsible(),
                            Section::make('Description')
                                ->schema([
                                    TextEntry::make('description')
                                        ->hiddenLabel()
                                        ->label('Description')
                                        ->html(),
                                ])->collapsible(),
                            Section::make('Store Info')
                                ->columns(3)
                                ->schema(function ($record) {
                                    if ($record->store) {
                                        return [
                                            TextEntry::make('store.name'),
                                            TextEntry::make('store.status')->badge(),
                                            TextEntry::make('store.contact_no'),
                                        ];
                                    }

                                    return [
                                        TextEntry::make('no_store')
                                            ->hiddenLabel()
                                            ->default('No store data'),
                                    ];
                                })
                                ->collapsible()
                        ])->columnSpan(9),
                    Grid::make(1)
                        ->schema([
                            Section::make('Image')
                                ->schema([
                                    SpatieMediaLibraryImageEntry::make('image')
                                        ->collection('products')
                                        ->imageSize(220)
                                        ->alignCenter()
                                        ->hiddenLabel()
                                        ->helperText(
                                            fn($record) =>
                                            $record && $record->getMedia('products')->isNotEmpty()
                                                ? ''
                                                : 'No images uploaded yet'
                                        )
                                        ->columns(12),
                                ])->collapsible(),
                        ])->columnSpan(3),
                ])->columnSpanFull(),
        ]);
    }
}
