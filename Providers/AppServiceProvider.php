<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;
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
    public function boot()
    {
        // Composer global untuk semua view
        View::composer('*', function ($view) {
            $notificationCount = 0;

            if (Auth::check()) {
                $notificationCount = EventRegistration::where('id_users', Auth::id())
                                    ->where('status_pembayaran', 'pending')
                                    ->count();
            }

            $view->with('notificationCount', $notificationCount);
        });
    }
}
