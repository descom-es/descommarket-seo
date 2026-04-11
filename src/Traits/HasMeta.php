<?php

namespace DescomMarket\Seo\Traits;

use DescomMarket\Seo\Models\Meta;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasMeta
{
    public function meta(): MorphOne
    {
        return $this->morphOne(Meta::class, 'seoable');
    }

    public function addMetaTitle(string $title, ?string $lang = null): void
    {
        $this->addMeta('title', $title, $lang);
    }

    public function addMetaDescription(string $description, ?string $lang = null): void
    {
        $this->addMeta('description', $description, $lang);
    }

    public function addMeta(string $key, string $value, ?string $lang = null): void
    {
        $meta = $this->meta()->first() ?? new Meta([
            'payload' => new \stdClass(),
        ]);

        $lang = $lang ?? config('app.locale');

        $currentPayload = json_decode(json_encode($meta->payload), true);
        $meta->payload = array_merge($currentPayload, [
            $lang => array_merge(
                $currentPayload[$lang] ?? [],
                [
                    $key => $value,
                ],
            ),
        ]);

        $this->meta()->save($meta);
    }

    public function addMetas(array $metas, ?string $lang = null)
    {
        foreach ($metas as $key => $value) {
            if ($key === 'robots') {
                $this->addRobots($value);

                continue;
            }

            $this->addMeta($key, $value, $lang);
        }
    }

    public function addRobots(?string $robots): void
    {
        $meta = $this->meta()->first() ?? new Meta(['payload' => new \stdClass()]);

        $meta->robots = $robots;
        $this->meta()->save($meta);
    }
}
