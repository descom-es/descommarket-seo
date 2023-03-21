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

            if (!class_exists('CreateTableSeo')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_table_seo.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_seo_table.php'),

                ], 'migrations');
            }

            $this->commands([
                Install::class,
            ]);
        }
    }
}
