<?php

namespace App\Filament\Resources\Stores\Schemas;

use App\Models\User;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;

class StoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Store Info')
                ->schema([
                    Select::make('user_id')
                        ->label('Merchant User')
                        ->relationship(
                            name: 'user',
                            titleAttribute: 'name',
                            modifyQueryUsing: fn($query) =>
                            $query->whereHas(
                                'roles',
                                fn($q) => $q->where('name', 'merchant')
                            )
                        )
                        ->getOptionLabelFromRecordUsing(
                            fn(User $record) => "{$record->name} ({$record->email})"
                        )
                        ->searchable()
                        ->preload()
                        ->required()
                        ->visible(fn() => ! auth()->user()?->hasRole('merchant')),

                    TextInput::make('name')
                        ->label('Store Name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('contact_no')
                        ->label('Contact Number')
                        ->tel()
                        ->maxLength(20),

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            0 => 'Inactive',
                            1 => 'Active',
                        ])
                        ->default(1)
                        ->required(),

                    Select::make('template')
                        ->label('Store Template')
                        ->options([
                            'classic'  => 'Classic (Products)',
                        ])
                        ->default('classic')
                        ->required(),

                    RichEditor::make('description')
                        ->label('Description')
                        ->columnSpanFull(),

                    SpatieMediaLibraryFileUpload::make('image')
                        ->label('Store Logo')
                        ->image()
                        ->collection('store')
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Theme')
                ->schema([
                    ColorPicker::make('theme.primary')
                        ->label('Primary Color')
                        ->default('#000000'),

                    Select::make('theme.header_background_type')
                        ->label('Header Background Type')
                        ->options([
                            'color' => 'Color',
                            'image' => 'Image',
                        ])
                        ->default('color')
                        ->reactive(),

                    ColorPicker::make('theme.background_color')
                        ->label('Header Background Color')
                        ->visible(fn($get) => $get('theme.header_background_type') === 'color'),

                    FileUpload::make('theme.background_image')
                        ->label('Header Background Image')
                        ->image()
                        ->directory('store-backgrounds')
                        ->visible(fn($get) => $get('theme.header_background_type') === 'image'),

                    TextInput::make('theme.background_opacity')
                        ->label('Image Overlay Opacity (0–1)')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(1)
                        ->step(0.1)
                        ->default(0.6)
                        ->visible(fn($get) => $get('theme.header_background_type') === 'image'),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Social & Links')
                ->schema([
                    Repeater::make('links')
                        ->schema([
                            Select::make('type')
                                ->options([
                                    'whatsapp'  => 'WhatsApp',
                                    'instagram' => 'Instagram',
                                    'tiktok'   => 'TikTok',
                                    'website'  => 'Website',
                                ])
                                ->required(),

                            TextInput::make('url')
                                ->required()
                                ->url(),
                        ])
                        ->columns(2)
                        ->addActionLabel('Add Link')
                        ->collapsible(),
                ])
                ->columnSpanFull(),
        ]);
    }
}
