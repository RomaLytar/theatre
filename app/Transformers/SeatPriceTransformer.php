<?php

namespace App\Transformers;

use App\Models\Seat;
use App\Models\SeatPrice;
use League\Fractal\TransformerAbstract;

class SeatPriceTransformer extends TransformerAbstract
{
    public function transform(SeatPrice $seatPrice) {
        return [
            'id' => $seatPrice->id,
            'seat_number' => $seatPrice->seat->number,
            'seat_recommended' => $seatPrice->seat->recommended,
            'seat_preview' => $seatPrice->seat->getFirstMediaUrl('posters', 'preview') ?? null,
            'seat_poster' => $seatPrice->seat->getFirstMediaUrl('posters') ?? null,
            'price_zone_id' => $seatPrice->price_zone_id,
            'row_number' => $seatPrice->seat->row->number,
            'section_number' => $seatPrice->seat->row->section->number,
            'section_title' => $seatPrice->seat->row->section->translate->title,
            'price' => isset($seatPrice->priceZone->price) ? (float)$seatPrice->priceZone->price : null,
        ];
    }
}
