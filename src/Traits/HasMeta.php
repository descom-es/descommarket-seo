<?php

namespace DescomMarket\Seo\Traits;

use DescomMarket\Seo\Models\Meta;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMeta
{
    public function meta(): MorphMany
    {
        return $this->morphMany(Meta::class, 'seoable');
    }

    public function addMetaDescription(string $description, ?string $lang = null): void
    {
        $this->addMeta('meta_description', $description, $lang);
    }

    private function addMeta(string $key, string $value, ?string $lang = null): void
    {
        $payload = $this->meta()->select('payload')->where('key', $key)->first()->payload ?? (object)[];
        $lang = $lang ?? config('app.lang');

        $payload->$lang = $value;

        $this->meta()->updateOrCreate(
            [
                'key' => $key,

            ],
            [
                'payload' => $payload,
            ]
        );
    }

    public function addMetas(array $metas, ?string $lang = null)
    {
        foreach ($metas as $meta) {
            $this->addMeta($meta['key'], $meta['value'], $lang);
        }
    }
}
