<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    public function mount(): void
    {
        parent::mount();

        $user = auth()->user();

        // If merchant and no store → block access
        if ($user?->hasRole('merchant') && ! $user->stores()->exists()) {
            abort(403, 'You must create a store first.');
        }
    }
}