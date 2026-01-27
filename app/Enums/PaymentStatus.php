<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: int implements HasColor, HasIcon, HasLabel
{
    use EnumHelper;

    case Unpaid = 0;
    case Paid = 1;
    case Failed = 2;

    public function getLabel(): ?string
    {
        return str($this->name)->snake()->headline();
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Unpaid => 'danger',
            self::Paid => 'success',
            self::Failed => 'warning',
            default => 'warning'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Paid => 'heroicon-m-check',
            self::Unpaid => 'heroicon-m-question-mark-circle',
            self::Failed => 'heroicon-m-x-circle',
            default => ''
        };
    }
}
