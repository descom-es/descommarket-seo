<?php

namespace DescomMarket\Seo\Tests\Unit;

use DescomMarket\Seo\Tests\Stubs\Demo;
use DescomMarket\Seo\Tests\Stubs\DemoResource;
use DescomMarket\Seo\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResourceTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateMeta()
    {
        $demo = Demo::first();

        $demo->addMeta('description', 'Mejor producto');
        $demo->addMeta('description_short', 'ermejo');

        $json = json_decode((new DemoResource($demo))->toJson());

        $this->assertEquals($json->meta->description, 'Mejor producto');
        $this->assertEquals($json->meta->description_short, 'ermejo');
    }

    public function testCreateMeta2()
    {
        $demo = Demo::with('meta')->first();

        $json = json_decode((new DemoResource($demo))->toJson());

        $this->assertNull($json->meta);
    }
}
