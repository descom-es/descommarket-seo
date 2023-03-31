<?php

namespace Descom\DescommarketSeo\Tests\Stubs;

use Descom\DescommarketSeo\Traits\HasMeta;
use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    use HasMeta;

    public function getAttribute($key)
    {
        return 1;
    }
}
