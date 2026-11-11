<?php

namespace DescomMarket\Seo\Tests\Feature;

use DescomMarket\Seo\Models\Meta;
use DescomMarket\Seo\Tests\Stubs\Demo;
use DescomMarket\Seo\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteMetaTest extends TestCase
{
    use RefreshDatabase;

    public function testAlBorrarElModeloSeBorraSuMeta()
    {
        $demo = Demo::first();
        $other = Demo::create([]);

        $demo->addMetaDescription('Mejor producto');
        $other->addMetaDescription('Otro producto');

        $demo->delete();

        $this->assertSame(0, Meta::where('seoable_type', Demo::class)->where('seoable_id', $demo->getKey())->count());
        $this->assertNotNull($other->meta()->first());
    }
}
