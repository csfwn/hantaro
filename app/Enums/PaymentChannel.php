<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentChannel: int implements HasColor, HasIcon, HasLabel
{
    use EnumHelper;

    case Fpx = 1;
    case DuitNowQr = 6;
    
    public function getLabel(): ?string
    {
        return str($this->name)->snake()->headline();
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Fpx => 'primary',
            self::DuitNowQr => 'success',
            default => 'warning'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            // self::Fpx => 'heroicon-m-clock',
            // self::DuitNowQr => 'heroicon-m-check',
            // self::Delivering => 'heroicon-m-truck',
            default => ''
        };
    }
}
