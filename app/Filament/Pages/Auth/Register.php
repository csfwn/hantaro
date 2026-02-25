<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use App\Models\User;

class Register extends BaseRegister
{
    public function getHeading(): string
    {
        return 'Create your account';
    }

    protected function handleRegistration(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $user->assignRole('merchant'); // ✅ SPATIE ROLE

        return $user;
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.pages.onboarding');
    }
}