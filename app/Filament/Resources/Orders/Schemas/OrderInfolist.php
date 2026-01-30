<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use App\Models\Order;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Number;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        $currencyCode = config('params.currency_code');

        return $schema->components([
            Section::make('Order Details')
                ->schema([
                    TextEntry::make('ref_no')
                        ->label('Order ID')
                        ->weight('bold'),
                    TextEntry::make('created_at')
                        ->label('Created At')
                        ->dateTime('d M Y, H:i'),
                    TextEntry::make('status')
                        ->badge()
                        ->label('Order Status'),
                ])
                ->columns(3)
                ->columnSpanFull(),

            Section::make('Customer Details')
                ->schema([
                    TextEntry::make('customer_name')->label('Name'),
                    TextEntry::make('customer_phone')->label('Phone'),
                    TextEntry::make('customer_email')->label('Email')->icon('heroicon-m-envelope'),
                    TextEntry::make('customer_address')
                        ->label('Address')
                        ->columnSpanFull(),
                ])
                ->columns(3)
                ->columnSpanFull(),

            Section::make('Product Details')
                ->schema([
                    RepeatableEntry::make('products')
                        ->hiddenLabel()
                        ->table([
                            TableColumn::make('Name'),
                            TableColumn::make('Quantity')->alignCenter(),
                            TableColumn::make('Price')->alignRight(),
                            TableColumn::make('Subtotal')->alignRight(),
                        ])
                        ->schema([
                            TextEntry::make('name'),
                            TextEntry::make('quantity')->alignCenter(),
                            TextEntry::make('price')
                                ->money($currencyCode)
                                ->alignRight(),
                            TextEntry::make('subtotal')
                                ->money($currencyCode)
                                ->alignRight(),
                        ]),
                ])
                ->columnSpanFull(),

            Section::make('Payment Summary')
                ->schema([
                    TextEntry::make('total_amount')
                        ->label('Total Amount')
                        ->money($currencyCode),

                    TextEntry::make('delivery_fee')
                        ->label('Delivery Fee')
                        ->money($currencyCode),

                    TextEntry::make('service_fee')
                        ->label('Service Fee')
                        ->money($currencyCode),

                    TextEntry::make('paid_amount')
                        ->label('Paid Amount')
                        ->money($currencyCode)
                        ->weight('bold'),

                    TextEntry::make('payment_method')
                        ->badge()
                        ->label('Payment Method'),

                    TextEntry::make('payment_status')
                        ->badge()
                        ->label('Payment Status'),
                ])
                ->columns(3)
                ->columnSpanFull(),
        ]);
    }
}

