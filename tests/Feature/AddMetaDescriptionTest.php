<?php

namespace DescomMarket\Seo\Tests\Unit;

use DescomMarket\Seo\Tests\Stubs\Demo;
use DescomMarket\Seo\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddMetaDescriptionTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateMetaDescription()
    {
        $demo = Demo::first();

        $es = 'Mejor producto';
        $en = 'Best product';

        $demo->addMetaDescription($es);

        $this->assertDatabaseHas('seo_meta', [
            'seoable_id' => $demo->getKey(),
            'payload->es->description' => $es,
        ]);

        $demo->addMetaDescription($en, "en");

        $this->assertDatabaseHas('seo_meta', [
            'seoable_id' => $demo->getKey(),
            'payload->en->description' => $en,
            'payload->es->description' => $es,
        ]);
    }

    public function testCreateMetasDescriptionArray()
    {
        $demo = Demo::first();

        $es = 'Mejor producto';
        $es2 = 'Mejor producto 2';

        $metas = [
            'title' => $es,
            'description' => $es2,
        ];

        $demo->addMetas($metas);

        $this->assertDatabaseHas('seo_meta', [
            'seoable_id' => $demo->getKey(),
            'payload->es->title' => $es,
        ]);

        $this->assertDatabaseHas('seo_meta', [
            'seoable_id' => $demo->getKey(),
            'payload->es->description' => $es2,
        ]);

        $en = 'Best product';
        $en2 = 'Best product 2';

        $metas = [
            'title' => $en,
            'description' => $en2,
        ];

        $demo->addMetas($metas, 'en');

        $this->assertDatabaseHas('seo_meta', [
            'seoable_id' => $demo->getKey(),
            'payload->en->title' => $en,
            'payload->es->title' => $es,
        ]);
    }
}
