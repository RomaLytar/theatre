<?php

namespace App\Transformers;

use App\Models\Seat;
use League\Fractal\TransformerAbstract;

class SeatTransformer extends TransformerAbstract
{
    public function transform(Seat $seat) {
        return [
            'id' => $seat->id,
            'number' => $seat->number,
            'poster' => $seat->getFirstMediaUrl('posters', 'preview') ?? null,
            'recommended' => $seat->recommended,
        ];
    }
}