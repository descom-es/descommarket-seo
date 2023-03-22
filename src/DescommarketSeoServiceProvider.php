<?php

namespace Descom\DescommarketSeo;

use Descom\DescommarketSeo\Console\Install;
use Illuminate\Support\ServiceProvider;

class DescommarketSeoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'skeleton');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('skeleton.php'),
            ], 'config');

            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

            $this->commands([
                Install::class,
            ]);
        }
    }
}
