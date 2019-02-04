<?php

namespace App\Transformers;

use App\Models\PricePattern;
use App\Models\PriceZone;
use App\Models\Seat;
use League\Fractal\TransformerAbstract;

class PricePatternTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['priceZones'];

    public function transform(PricePattern $pricePattern) {
        return [
            'id' => $pricePattern->id,
            'title' => $pricePattern->title,
        ];
    }

    public function includePriceZones(PricePattern $pricePattern) {
        return $this->collection($pricePattern->priceZones, new PriceZoneTransformer());
    }
}