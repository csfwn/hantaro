<?php

namespace App\Filament\Resources\Stores\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;

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
                    RichEditor::make('description')
                        ->label('Description')
                        ->extraAttributes(['style' => 'min-height:200px'])
                        ->columnSpanFull(),
                    SpatieMediaLibraryFileUpload::make('image')
                        ->label('Store Logo')
                        ->image()
                        ->collection('store')
                        ->columnSpanFull(),
                ])->columns(2)->columnSpanFull(),
            ]);
    }
}
