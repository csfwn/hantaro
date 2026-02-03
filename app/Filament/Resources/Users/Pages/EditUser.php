<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['role'] = $this->record->roles->pluck('name')->first();

        return $data;
    }

    protected function afterSave(): void
    {
        if ($role = $this->data['role'] ?? null) {
            $this->record->syncRoles([$role]);
        }
    }
}
