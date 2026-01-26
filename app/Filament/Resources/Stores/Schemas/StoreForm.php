<?php

namespace App\Filament\Resources\Stores\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

class StoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('name')
                        ->label('Store Name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('contact_no')
                        ->label('Contact Number')
                        ->tel() // adds numeric keyboard on mobile
                        ->maxLength(20),

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            0 => 'Inactive',
                            1 => 'Active',
                        ])
                        ->required()
                        ->default(1),
                ])->columns(2)->columnSpanFull(),
            ]);
    }
}
