<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Services\TikTokProductSyncService;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->disabled(function () {
                    $user = auth()->user();

                    if ($user?->hasRole('merchant')) {
                        return ! $user->stores()->exists();
                    }

                    return false;
                })
                ->tooltip(function () {
                    $user = auth()->user();

                    if ($user?->hasRole('merchant') && ! $user->stores()->exists()) {
                        return 'You need to create a store first.';
                    }

                    return null;
                }),

            // Optional TikTok Sync (kept clean)
            /*
            Action::make('syncTikTokProducts')
                ->label('Sync TikTok Products')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Sync TikTok Products')
                ->modalDescription(
                    'This will sync ALL products from TikTok Shop. The page will wait until sync completes.'
                )
                ->action(function (TikTokProductSyncService $service) {
                    try {
                        $service->process();

                        Notification::make()
                            ->title('TikTok products synced successfully')
                            ->success()
                            ->send();

                        $this->dispatch('$refresh');
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title('TikTok product sync failed')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            */
        ];
    }
}