<?php

namespace Descom\DescommarketSeo\Tests\Unit;

use Descom\DescommarketSeo\Tests\Stubs\Demo;
use Descom\DescommarketSeo\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddMetaDescriptionTest extends TestCase
{

    use RefreshDatabase;

    public function testCreateMetaDescription()
    {
        $demo = new Demo();

        $es = 'Mejor producto';
        $en = 'Best product';



        $demo->addMetaDescription($es);

        $this->assertDatabaseHas('seo', [
            'seable_id' => $demo->getKey(),
            'payload->es' => $es,
        ]);

        $demo->addMetaDescription($en, "en");

        $this->assertDatabaseHas('seo', [
            'seable_id' => $demo->getKey(),
            'payload->en' => $en,
            'payload->es' => $es,
        ]);
    }
}
