<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: int implements HasColor, HasIcon, HasLabel
{
    use EnumHelper;

    case New = 0;
    case Pending = 1;
    case Failed = 2;
    case Success = 3;
    case Cancelled = 4;

    public function getLabel(): ?string
    {
        return str($this->name)->snake()->headline();
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Failed => 'danger',
            self::Success => 'success',
            self::Pending => 'warning',
            default => 'warning'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Success => 'heroicon-m-check',
            self::Pending => 'heroicon-m-question-mark-circle',
            self::Failed => 'heroicon-m-x-circle',
            default => ''
        };
    }
}
