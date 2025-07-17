<?php

namespace App\Http\Middleware;

use App\Filament\Admin\Pages\EditProfile;
use Closure;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureMobileIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Filament::auth()->user();

        // Check if user is authenticated, mobile is not verified, and not already on the edit profile page or logging out.
        if (
            $user &&
            is_null($user->mobile_verified_at) &&
            !$request->routeIs(EditProfile::getRouteName()) &&
            !$request->routeIs('filament.admin.auth.logout') // Use your panel's logout route name
        ) {
            // Send a persistent notification
            Notification::make()
                ->title('لطفاً شماره موبایل خود را تأیید کنید')
                ->warning()
                ->body('برای دسترسی به تمام امکانات پنل، نیاز به تأیید شماره موبایل خود دارید.')
                ->persistent()
                ->send();

            // Redirect to the edit profile page
            return redirect()->route(EditProfile::getRouteName());
        }

        return $next($request);
    }
}
