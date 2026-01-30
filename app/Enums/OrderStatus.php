<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: int implements HasColor, HasIcon, HasLabel
{
    use EnumHelper;

    case Processing = 0;
    case Completed = 1;
    case Delivering = 2;
    
    public function getLabel(): ?string
    {
        return str($this->name)->snake()->headline();
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Processing => 'primary',
            self::Completed, self::Delivering => 'success',
            default => 'warning'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Processing => 'heroicon-m-clock',
            self::Completed => 'heroicon-m-check',
            self::Delivering => 'heroicon-m-truck',
            default => ''
        };
    }
}
