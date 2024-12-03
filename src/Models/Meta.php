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
            get: fn ($value) => $this->payload->$lang
                ?? $this->payload->$langDefault
                ?? $this->payload->$langFallback
                ?? null
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
