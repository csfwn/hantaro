<?php

namespace App\Enums;

use Illuminate\Support\Str;

trait EnumHelper
{
    public static function options(): array
    {
        $cases = static::cases();

        return isset($cases[0]) && $cases[0] instanceof \BackedEnum
            ? array_column($cases, 'value', 'name')
            : array_column($cases, 'name');
    }

    public static function selectOptions(): array
    {
        $collect = collect(self::options())
            ->flip();

        return $collect->toArray();
    }

    public static function firstOption(): int | null
    {
        return collect(self::options())->first() ?? null;
    }
}
