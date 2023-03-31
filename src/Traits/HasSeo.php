<?php

namespace Descom\DescommarketSeo\Traits;

use Descom\DescommarketSeo\Models\Seo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasSeo
{
    public function seo(): MorphMany
    {
        return $this->morphMany(Seo::class, 'seable');
    }

    public function addMetaDescription(string $description, ?string $lang = null): void
    {
        $this->addMeta('meta_description', $description, $lang);
    }

    private function addMeta(string $key, string $value, ?string $lang = null): void
    {
        $payload = $this->seo()->select('payload')->where('key', $key)->first()->payload ?? (object)[];
        $lang = $lang ?? config('app.lang');

        $payload->$lang = $value;

        $this->seo()->updateOrCreate(
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
