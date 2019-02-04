<?php

namespace App\Repositories;

use App\Models\Color;
use App\Models\PerformanceCalendar;
use App\Models\PricePattern;
use App\Models\PriceZone;
use Illuminate\Container\Container as App;

class PerformanceCalendarRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return PerformanceCalendar::class;
    }

    public function editPerformanceCalendar($data, $id)
    {
        $array = [
            'hall_price_pattern_id' => $data['hall_price_pattern_id'] ?? null,
            'isSoldInCashBox' => $data['isSoldInCashBox'] ?? false,
            'isSoldOnline' => $data['isSoldOnline'] ?? false,
        ];

        $this->update($array, ['id' => $id]);
    }

    public function ticketsWereGenerated($id) {
        $array = [
            'areTicketsGenerated'  => true,
        ];
        $this->update($array, ['id' => $id]);
    }

    public function ticketsWereDeleted($id) {
        $array = [
            'areTicketsGenerated'  => false,
        ];
        $this->update($array, ['id' => $id]);
    }
}
