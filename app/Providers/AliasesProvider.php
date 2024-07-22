<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class Alias extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('OneSignal', Berkayk\OneSignal\OneSignalFacade::class)
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
