<?php

namespace Descom\DescommarketSeo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $fillable = [
        "seable",
        "key",
        "payload",
    ];

    protected $casts = [
        'payload' => 'object',
    ];
}
