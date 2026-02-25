<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use l3aro\FilamentTurnstile\Forms\Turnstile;
class Register extends BaseRegister
{
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255)
                ->rule('email:rfc,dns')
                ->unique(User::class, 'email')
                ->rule('indisposable'),

            TextInput::make('password')
                ->password()
                ->required()
                ->confirmed()
                ->rule(
                    Password::min(8)
                        ->letters()
                        ->numbers()
                        ->mixedCase()
                ),

            TextInput::make('password_confirmation')
                ->password()
                ->required(),

            Turnstile::make('captcha')
                ->theme('light')     
                ->size('flexible') 
                ->language('en-US')
                ->resetEvent('reset-captcha')
        ]);
    }

    protected function handleRegistration(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $user->assignRole('merchant');

        // 🔥 Send verification email
        // $user->sendEmailVerificationNotification();

        return $user;
    }

    protected function getRedirectUrl(): string
    {
        return route('verification.notice');
    }
}