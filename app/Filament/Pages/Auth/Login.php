<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Login as BaseAuth;

class Login extends BaseAuth
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //$this->getEmailFormComponent(),
                $this->getMobileFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getMobileFormComponent(): Component
    {
        return TextInput::make('mobile')
            ->label('موبایل')
            ->required()
            ->regex('/^09[0-9]{9}$/')
            ->validationMessages([
                'regex' => 'فرمت شماره موبایل صحیح نمی‌باشد.',
            ])
            ->tel();
    }
}
