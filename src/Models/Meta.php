<?php

namespace DescomMarket\Seo\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;

/**
 * @property object|array $payload
 * @property string|null $robots
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
        return Attribute::make(
            get: function () {
                $meta = $this->getMetaByLang();

                if (!empty($this->robots)) {
                    $meta->robots = $this->robots;
                }

                return $meta;
            },
        );
    }

    public function getMetaByLang(?string $lang = null): object
    {
        $langDefault = config('app.locale');
        $langFallback = config('app.fallback_locale');

        return $this->payload->$lang
            ?? $this->payload->$langDefault
            ?? $this->payload->$langFallback
            ?? new stdClass();
    }
}
