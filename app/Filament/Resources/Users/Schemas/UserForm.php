<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password as PasswordRule;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->required()
                        ->unique(
                            table: 'users',
                            column: 'email',
                            ignorable: fn($record) => $record
                        ),

                    Select::make('role')
                        ->label('Role')
                        ->options(
                            Role::query()->pluck('name', 'name')->toArray()
                        )
                        ->required()
                        ->native(false)
                        ->dehydrated(false),

                    TextInput::make('password')
                        ->password()
                        ->confirmed()
                        ->required(fn($record) => $record === null)
                        ->rule(PasswordRule::defaults())
                        ->dehydrateStateUsing(
                            fn($state) => filled($state) ? bcrypt($state) : null
                        )
                        ->dehydrated(fn($state) => filled($state)),

                    TextInput::make('password_confirmation')
                        ->password()
                        ->label('Confirm Password')
                        ->required(fn($record) => $record === null),
                ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
