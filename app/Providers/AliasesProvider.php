<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Berkayk\OneSignal\OneSignalFacade;

class Alias extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('OneSignal', OneSignalFacade::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
