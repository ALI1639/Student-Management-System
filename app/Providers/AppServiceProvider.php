<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\Setting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) {

            $setting = Setting::first();

            $navbarNotifications = Notification::latest()
                ->take(4)
                ->get();

            $unreadNotifications = Notification::where('is_read', false)
                ->count();

            $view->with([
                'setting' => $setting,
                'navbarNotifications' => $navbarNotifications,
                'unreadNotifications' => $unreadNotifications,
            ]);
        });



        Gate::define('manage-notifications', function ($user) {
            return $user->role === 'Admin';
        });

        Gate::define('manage-sitting', function ($user) {
            return $user->role === 'Admin';
        });
    }
}
