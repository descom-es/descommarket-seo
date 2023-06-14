<?php

namespace DescomMarket\Seo\Tests\Stubs;

use DescomMarket\Seo\Http\Resources\MetaResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $meta
 */
class DemoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'meta' => $this->whenLoaded('meta', new MetaResource($this->meta)),
        ];
    }
}
