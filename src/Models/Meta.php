<?php

namespace Descom\DescommarketSeo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $table = 'meta';

    protected $fillable = [
        "seoable",
        "key",
        "payload",
    ];

    protected $casts = [
        'payload' => 'object',
    ];
}
