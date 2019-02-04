<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\Hall;
use App\Models\HallTranslation;



class HallRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Hall';
  }

  public function createHall($data)
  {
    $hall = [
      'spaciousness' => $data['spaciousness'],
    ];
    $hall = $this->create($hall);
    $this->addTranslationHall($data, $hall->id);
    return $hall;
  }

  public function editHall($data, $id)
  {
    $array = [
      'spaciousness' => $data['spaciousness'],
    ];
    $this->update($array, ['id' => $id]);
    $hall = Hall::find($id);
    $this->editTranslationHall($data, $hall);
  }

  public function addTranslationHall($data, $hallId)
  {
    foreach (get_languages() as $lang => $val) {
      HallTranslation::create([
        'hall_id' => $hallId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'description' => $data['description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationHall($data, $hall)
  {
    foreach (get_languages() as $lang => $val) {
      $hallTranslation = HallTranslation::where(['hall_id' => $hall->id, 'language' => $lang])->first();
      $hallTranslation->update([
        'hall_id' => $hall->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'description' => $data['description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
