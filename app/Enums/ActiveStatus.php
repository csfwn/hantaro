<?php

namespace App\Enums;

use Filament\Support\Contracts\{HasLabel, HasColor, HasIcon};

enum ActiveStatus: int implements HasLabel, HasColor, HasIcon
{
    case Inactive = 0;
    case Active = 1;

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Inactive => 'gray',
            self::Active => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Active => 'heroicon-o-check-circle',
            self::Inactive => 'heroicon-o-x-circle',
        };
    }
}
