<?php

namespace DescomMarket\Seo\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $meta_data
 */
class MetaResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->meta_data;
    }
}
