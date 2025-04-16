<?php

namespace DescomMarket\Seo\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property object|array $payload
 */
class Meta extends Model
{
    use HasFactory;

    protected $table = 'seo_meta';

    protected $fillable = [
        "seoable",
        "payload",
        "robots",
    ];

    protected $casts = [
        'payload' => 'object',
    ];

    public function metaData(): Attribute
    {
        $langDefault = config('app.locale');
        $langFallback = config('app.fallback_locale');

        $lang = $langDefault;

        return Attribute::make(
            get: function ($value) use ($lang, $langDefault, $langFallback) {
                $data = $this->payload->$lang
                ?? $this->payload->$langDefault
                ?? $this->payload->$langFallback;

                $result = [];

                if ($data) {
                    $result = (array) $data;
                }

                if (!is_null($this->robots)) {
                    $result['robots'] = $this->robots;
                }

                return empty($result) ? null : $result;
            },
        );
    }

    public function getMetaByLang(?string $lang = null): ?object
    {
        $langDefault = config('app.locale');
        $langFallback = config('app.fallback_locale');

        return $this->payload->$lang
            ?? $this->payload->$langDefault
            ?? $this->payload->$langFallback
            ?? null;
    }
}
