<?php

namespace App\Repositories;
use App\Models\HallPricePattern;
use Illuminate\Container\Container as App;

class HallPricePatternRepository extends Repository
{
    /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return HallPricePattern::class;
  }

  public function createHallPricePattern($data)
  {
      $pricePattern = [
          'title' => $data['title'],
          'hall_id' => $data['hall_id'],
          'price_pattern_id' => $data['price_pattern_id'],
      ];
      $pricePattern = $this->create($pricePattern);

      return $pricePattern;
  }

  public function editHallPricePattern($data, $id) {
      $array = [
          'title' => $data['title'],
          'hall_id' => $data['hall_id'],
          'price_pattern_id' => $data['price_pattern_id'],
      ];

      $this->update($array, ['id' => $id]);

      $hallPricePattern = $this->find($id);

      return $hallPricePattern;
  }
}
