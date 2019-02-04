<?php

namespace App\Repositories;

use App\Models\Color;
use App\Models\PricePattern;
use App\Models\PriceZone;
use App\Models\Seat;
use Illuminate\Container\Container as App;

class SeatRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Seat::class;
    }

    public function editSeat($data, $id)
    {
        $array = [
            'recommended' => $data['recommended'],
        ];

        $this->update($array, ['id' => $id]);
    }
}
