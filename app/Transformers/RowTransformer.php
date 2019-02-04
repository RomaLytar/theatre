<?php

namespace App\Transformers;

use App\Models\Row;
use League\Fractal\TransformerAbstract;

class RowTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['seats'];

    public function transform(Row $row) {
        return [
            'id' => $row->id,
            'number' => $row->number,
        ];
    }

    public function includeSeats(Row $row) {
        return $this->collection($row->seats, new SeatTransformer());
    }
}