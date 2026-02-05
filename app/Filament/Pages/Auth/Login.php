<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as AuthLogin;
use Filament\Forms\Form;
use l3aro\FilamentTurnstile\Forms\Turnstile;
use l3aro\FilamentTurnstile\Facades\FilamentTurnstile;

class Login extends AuthLogin
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                        Turnstile::make('captcha')->required(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function throwFailureValidationException(): never
    {
        $this->dispatch(
            FilamentTurnstile::getResetEventName()
        );

        parent::throwFailureValidationException();
    }
}
