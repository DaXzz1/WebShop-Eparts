<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use Doctrine\Inflector\WordInflector;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer("partials.language-switcher", function ($view) {
            $view->with("current_locale", app()->getLocale());
            $view->with("available_locales", config("app.available_locales"));
        });

        Paginator::useTailwind();
    }
}
