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

        $this->assertDatabaseHas('meta', [
            'seoable_id' => $demo->getKey(),
            'payload->es' => $es,
        ]);

        $demo->addMetaDescription($en, "en");

        $this->assertDatabaseHas('meta', [
            'seoable_id' => $demo->getKey(),
            'payload->en' => $en,
            'payload->es' => $es,
        ]);
    }

    public function testCreateMetasDescriptionArray()
    {
        $demo = new Demo();

        $es = 'Mejor producto';
        $es2 = 'Mejor producto 2';

        $metas = [
            [
                'key' => 'title',
                'value' => $es,
            ],
            [
                'key' => 'description',
                'value' => $es2,

            ],
        ];

        $demo->addMetas($metas);

        $this->assertDatabaseHas('meta', [
            'seoable_id' => $demo->getKey(),
            'key' => 'title',
            'payload->es' => $es,
        ]);

        $this->assertDatabaseHas('meta', [
            'seoable_id' => $demo->getKey(),
            'key' => 'description',
            'payload->es' => $es2,
        ]);

        $en = 'Best product';
        $en2 = 'Best product 2';

        $metas = [
            [
                'key' => 'title',
                'value' => $en,
            ],
            [
                'key' => 'description',
                'value' => $en2,

            ],
        ];

        $demo->addMetas($metas, 'en');

        $this->assertDatabaseHas('meta', [
            'seoable_id' => $demo->getKey(),
            'key' => 'title',
            'payload->en' => $en,
            'payload->es' => $es,
        ]);
    }
}
