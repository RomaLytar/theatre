<?php

namespace App\Repositories;

use App\Models\AttributeValue;
use App\Models\AttributeValueTranslation;

class AttributeValueRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\AttributeValue';
  }

  public function createAttributeValues($data, $counter)
  {
    $attributeValue = [
      'attribute_id' => $data['attribute_id_' . $counter],
      'page_id' => $data['page_id'],
      'is_center' => $data['is_center'] ?? false
    ];

    $block = $this->create($attributeValue);

    $this->addTranslationAttributeValue($data, $block->id, $counter);
    return $block;
  }

  public function editAttributeValue($data, $id)
  {
    if(!isset($data['attribute_id_old_' . $id])) {
      AttributeValue::find($id)->delete();
      return 0;
    }
    $array = [
      'attribute_id' => $data['attribute_id_old_' . $id],
      'page_id' => $data['page_id'],
      'is_center' => $data['is_center_' . $id] ?? false
    ];
    $this->update($array, ['id' => $id]);
    $attributeValue = AttributeValue::find($id);
    $this->editTranslationAttributeValue($data, $attributeValue, $id);
    return $attributeValue;
  }

  public function addTranslationAttributeValue($data, $attributeValueId, $counter)
  {
    foreach (get_languages() as $lang => $val) {
      if(!isset($data['descriptions_' . $lang . '_' . $counter])) {
        $data['descriptions_' . $lang . '_' . $counter] = $data['descriptions_' . $counter] ?? '';
      }
      AttributeValueTranslation::create([
        'attribute_value_id' => $attributeValueId,
        'language' => $lang,
        'title' => $data['title_' . $lang . '_' . $counter],
        'descriptions' => $data['descriptions_' . $lang . '_' . $counter] ?? null,
      ]);
    }
  }

  public function editTranslationAttributeValue($data, $attributeValue, $id)
  {
    foreach (get_languages() as $lang => $val) {
      if(!isset($data['descriptions_' . $lang . '_old_' . $id])) {
        $data['descriptions_' . $lang . '_old_' . $id] = $data['descriptions_old_' . $id] ?? '';
      }
      $attributeValueTranslation = AttributeValueTranslation::where(['attribute_value_id' => $attributeValue->id, 'language' => $lang])->first();
      $attributeValueTranslation->update([
        'attribute_value_id' => $attributeValue->id,
        'language' => $lang,
        'title' => $data['title_' . $lang . '_old_' . $id],
        'descriptions' => $data['descriptions_' . $lang . '_old_' . $id],
      ]);
    }
  }
}
