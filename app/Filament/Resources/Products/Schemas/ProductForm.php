<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enums\ActiveStatus;
use App\Models\Store;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Product Tabs')->tabs([
                Tab::make('Basic Info')->schema([
                    TextInput::make('name')
                        ->label('Product Name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($state, $set) {
                            $set('slug', Str::slug($state));
                        }),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->live()
                        ->afterStateUpdated(fn($state, $set) => $set('slug', Str::slug($state))),

                    RichEditor::make('description')
                        ->label('Description')
                        ->extraAttributes(['style' => 'min-height:200px'])
                        ->columnSpanFull(),
                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ])->columns(2),

                Tab::make('Pricing & Stock')->schema([
                    TextInput::make('price')
                        ->label('Price')
                        ->numeric()
                        ->required()
                        ->prefix('RM'),

                    TextInput::make('discount_price')
                        ->label('Discount Price')
                        ->numeric()
                        ->prefix('RM'),

                    TextInput::make('stock')
                        ->label('Stock')
                        ->numeric()
                        ->default(0),
                ])->columns(2),

                Tab::make('Media')->schema([
                    SpatieMediaLibraryFileUpload::make('image')
                        ->label('Main Image')
                        ->image()
                        ->collection('products')
                        ->columnSpanFull(),

                    SpatieMediaLibraryFileUpload::make('gallery')
                        ->label('Gallery')
                        ->multiple()
                        ->image()
                        ->collection('products-gallery')
                        ->columnSpanFull(),
                ]),
                Tab::make('Store Info')->schema([
                    Select::make('store_id')
                        ->label('Store')
                        ->options(Store::where('status', ActiveStatus::Active->value)->pluck('name', 'id'))
                        ->searchable()
                        ->required()
                        ->placeholder('Select an active store'),
                ])->columnSpanFull(),
            ])->columnSpanFull(),
        ]);
    }
}
