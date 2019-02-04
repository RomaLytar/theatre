<?php

namespace App\Repositories;

class AttributeRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Attribute';
  }

  public function createAttributes($data)
  {
    $attribute = [
      'name' => $data['name'],
    ];

    $attribute = $this->create($attribute);
    return $attribute;
  }

  public function editAttribute($data, $attribute)
  {
    $array = [
      'name' => $data['name'],
    ];
    $this->update($array, ['id' => $attribute->id]);
  }
}
