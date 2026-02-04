<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Outerweb\FilamentSettings\Pages\Settings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class Setting extends Settings
{
    use HasPageShield;

    protected static string|UnitEnum|null $navigationGroup = 'System';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog8Tooth;

    protected static ?int $navigationSort = 3;


    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Settings')
                ->vertical()                 // LEFT sidebar tabs
                ->columnSpanFull()
                ->persistTabInQueryString()  // optional but nice UX
                ->tabs([
                    Tab::make('General')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            TextInput::make('general.brand_name')
                                ->label('Site name')
                                ->required(),

                            TextInput::make('general.site_description')
                                ->label('Site description'),
                        ]),

                    
                ]),
        ]);
    }
}
