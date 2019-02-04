<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/21/2018
 * Time: 2:16 PM
 */

namespace App\Repositories;
use App\Models\PerformanceType;
use App\Models\PerformanceTypeTranslation;


class PerformanceTypeRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\PerformanceType';
  }

  public function createPerformanceTypes($data)
  {

    $performanceType = [
        'name' => mb_strtolower(str_replace(' ', '_', $data['title_en']))
    ];
    $performanceType = $this->create($performanceType);
    $this->addTranslationPerformanceType($data, $performanceType->id);
  }

  public function editPerformanceType($data, $id)
  {
    $array = [
        'name' => mb_strtolower(str_replace(' ', '_', $data['title_en']))
    ];
    $this->update($array, ['id' => $id]);
    $performanceType = PerformanceType::find($id);
    $this->editTranslationPerformanceType($data, $performanceType);
  }

  public function addTranslationPerformanceType($data, $performanceTypeId)
  {
    foreach (get_languages() as $lang => $val) {
      PerformanceTypeTranslation::create([
        'performance_type_id' => $performanceTypeId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationPerformanceType($data, $performanceType)
  {
    foreach (get_languages() as $lang => $val) {
      $performanceTypeTranslation = PerformanceTypeTranslation::where(['performance_type_id' => $performanceType->id, 'language' => $lang])->first();
      $performanceTypeTranslation->update([
        'performance_type_id' => $performanceType->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
