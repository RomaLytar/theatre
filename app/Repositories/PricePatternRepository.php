<?php

namespace App\Repositories;
use App\Models\Color;
use App\Models\PricePattern;
use App\Models\PriceZone;
use Illuminate\Container\Container as App;

class PricePatternRepository extends Repository
{
    /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return PricePattern::class;
  }

  public function createPricePattern($data)
  {
      $pricePattern = [
          'title' => $data['title'],
      ];
      $pricePattern = $this->create($pricePattern);

      return $pricePattern;
  }

  public function editPricePattern($data, $id) {
      $array = [
          'title' => $data['title'],
      ];

      $this->update($array, ['id' => $id]);

      $pricePattern = $this->find($id);

      return $pricePattern;
  }
}
