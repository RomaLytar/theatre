<?php

namespace App\Repositories;
use App\Models\SeatPrice;

class SeatPriceRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return SeatPrice::class;
  }

  public function createSeatPrice($data)
  {
      $seatPrice = [
          'seat_id' => $data['seat_id'],
          'hall_price_pattern_id' => $data['hall_price_pattern_id'],
      ];
      $this->create($seatPrice);
  }

  public function editSeatPrice($data, $id) {
      $array = [
          'price_zone_id' => $data['price_zone_id'],
      ];
      $this->update($array, ['id' => $id]);
  }
}
