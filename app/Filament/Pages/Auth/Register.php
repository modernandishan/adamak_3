<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Pages\Auth\Register as BaseAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use MarcoGermani87\FilamentCaptcha\Forms\Components\CaptchaField;

class Register extends BaseAuth
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getFamilyFormComponent(),
                        $this->getMobileFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        CaptchaField::make('captcha')
                            ->label('کد امنیتی'),

                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getFamilyFormComponent(): Component
    {
        return TextInput::make('family')
            ->label('نام خانوادگی')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }
    protected function getMobileFormComponent(): Component
    {
        return TextInput::make('mobile')
            ->label('موبایل')
            ->required()
            ->unique('users', 'mobile')
            ->regex('/^09[0-9]{9}$/')
            ->validationMessages([
                'regex' => 'فرمت شماره موبایل صحیح نمی‌باشد.',
                'unique' => 'این شماره موبایل قبلا ثبت شده است.',
            ])
            ->tel();
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('رمز عبور')
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->rule(Password::default())
            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
            ->same('passwordConfirmation')
            ->validationMessages([
                'required' => 'وارد کردن رمز عبور الزامی است.',
                'same' => 'رمز عبور و تکرار آن باید یکسان باشند.',
                'password.min' => 'رمز عبور باید حداقل :min کاراکتر باشد.',
                'password.letters' => 'رمز عبور باید شامل حروف باشد.',
                'password.mixed' => 'رمز عبور باید شامل حروف بزرگ و کوچک باشد.',
                'password.numbers' => 'رمز عبور باید شامل اعداد باشد.',
                'password.symbols' => 'رمز عبور باید شامل نمادها باشد.',
            ]);
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('passwordConfirmation')
            ->label('تکرار رمز عبور')
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->dehydrated(false);
    }
}
