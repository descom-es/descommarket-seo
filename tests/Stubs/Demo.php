<?php

namespace Descom\DescommarketSeo\Tests\Stubs;

use Descom\DescommarketSeo\Traits\HasSeo;
use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    use HasSeo;

    public function getAttribute($key)
    {
        return 1;
    }
}
