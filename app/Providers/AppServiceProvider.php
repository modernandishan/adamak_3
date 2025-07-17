<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
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
        User::observe(UserObserver::class);
        Validator::extend('captcha', function ($attribute, $value, $parameters, $validator) {
            // در اینجا باید منطق بررسی کپچا را اضافه کنید.
            // برای نمونه، اگر مقدار کپچا در نشست (session) ذخیره شده باشد:
            return $value === session('captcha_code');
        }, 'کد امنیتی صحیح نمی‌باشد.');
    }
}
