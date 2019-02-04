<?php

namespace App\Repositories;
use App\Models\Color;
use App\Models\PricePattern;
use App\Models\PriceZone;

class PriceZoneRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return PriceZone::class;
  }

  public function createPriceZone($data)
  {
      $priceZone = [
          'price_pattern_id' => $data['price_pattern_id'],
          'color_id' => $data['color_id'],
      ];
      $this->create($priceZone);
  }

  public function editPriceZone($data, $id) {
      $array = [
          'price' => $data['price_' . $id],
          'isActive' => $data['isActive_' . $id] ?? false,
      ];
      $this->update($array, ['id' => $id]);
  }
}
