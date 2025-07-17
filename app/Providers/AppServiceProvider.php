<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Filament\Forms\Components\DateTimePicker;
use Filament\Infolists\Infolist;
use Filament\Tables\Table;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Table::$defaultDateDisplayFormat = 'Y-m-d';
        Table::$defaultDateTimeDisplayFormat = 'Y-m-d H:i:s';

        Infolist::$defaultDateDisplayFormat = 'Y-m-d';
        Infolist::$defaultDateTimeDisplayFormat = 'Y-m-d H:i:s';

        DateTimePicker::$defaultDateDisplayFormat = 'Y-m-d';
        DateTimePicker::$defaultDateTimeDisplayFormat = 'Y-m-d H:i';
        DateTimePicker::$defaultDateTimeWithSecondsDisplayFormat = 'Y-m-d H:i:s';

        User::observe(UserObserver::class);
        Validator::extend('captcha', function ($attribute, $value, $parameters, $validator) {
            // در اینجا باید منطق بررسی کپچا را اضافه کنید.
            // برای نمونه، اگر مقدار کپچا در نشست (session) ذخیره شده باشد:
            return $value === session('captcha_code');
        }, 'کد امنیتی صحیح نمی‌باشد.');
    }
}
