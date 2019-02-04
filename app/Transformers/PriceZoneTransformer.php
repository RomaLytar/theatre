<?php

namespace App\Transformers;

use App\Models\PriceZone;
use App\Models\Seat;
use League\Fractal\TransformerAbstract;

class PriceZoneTransformer extends TransformerAbstract
{
    public function transform(PriceZone $priceZone) {
        return [
            'id' => $priceZone->id,
            'color_name' => $priceZone->color->title,
            'color_code' => $priceZone->color->code,
            'price' => (float)$priceZone->price,
            'isActive' => $priceZone->isActive,
        ];
    }
}
