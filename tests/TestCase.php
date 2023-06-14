<?php

namespace DescomMarket\Seo\Tests;

use DescomMarket\Seo\DescommarketSeoServiceProvider;
use DescomMarket\Seo\Tests\Stubs\Demo;
use Illuminate\Support\Facades\Schema;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Schema::create('demos', function ($table) {
            $table->increments('id');
            $table->timestamps();
        });

        Demo::create([]);
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            DescommarketSeoServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
        $app['config']->set('app.locale', 'es');
    }
}
