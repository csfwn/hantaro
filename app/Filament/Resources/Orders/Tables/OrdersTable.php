<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ref_no')
                    ->label('Ref No')
                    ->searchable(),

                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->description(fn(Model $record) => $record->customer_phone),

                TextColumn::make('customer_url')
                    ->label('URL')
                    ->copyable(),

                TextColumn::make('total_amount')
                    ->label('Total Amount')
                    ->money(fn($record) => $record->currency_code)
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('status')
                    ->badge()
                    ->alignCenter(),

                TextColumn::make('payment_status')
                    ->badge()
                    ->alignCenter(),

                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->badge()
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])

            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(
                        collect(PaymentStatus::cases())
                            ->mapWithKeys(fn($case) => [$case->value => $case->name])
                    )
                    ->native(false),

                DateRangeFilter::make('created_at')
                    ->icon('heroicon-o-x-circle')
                    ->disableClear(false)
                    ->displayFormat('YYYY-MM-DD')
                    ->format('Y-m-d'),
            ])
            ->striped()
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    // EditAction::make(),
                ]),
                Action::make('updateStatus')
                    ->label('Update Status')
                    ->color('warning')
                    ->modalHeading('Update Order Status')
                    ->modalSubmitActionLabel('Update')
                    ->modalWidth('md')
                    ->schema([
                        Select::make('status')
                            ->label('Order Status')
                            ->options(
                                collect(OrderStatus::cases())
                                    ->mapWithKeys(fn($case) => [
                                        $case->value => $case->getLabel(),
                                    ])
                            )
                            ->required()
                            ->native(false),
                    ])

                    ->mountUsing(function ($form, Order $record) {
                        $form->fill([
                            'status' => $record->status,
                        ]);
                    })

                    ->action(function (array $data, Order $record) {
                        $record->update([
                            'status' => $data['status'],
                        ]);

                        Notification::make()
                            ->title('Order status updated')
                            ->body('Order has been successfully updated.')
                            ->success()
                            ->send();
                    }),

            ], position: RecordActionsPosition::BeforeColumns)

            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
