<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\Service;
use App\Models\ServiceTranslation;

class ServiceRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Service';
  }

  public function createService($data)
  {
    $service = [
    ];
    $service = $this->create($service);
    $this->addTranslationService($data, $service->id);
    return $service;
  }

  public function editService($data, $id)
  {
    $array = [
    ];
    $this->update($array, ['id' => $id]);
    $service = Service::find($id);
    $this->editTranslationService($data, $service);
  }

  public function addTranslationService($data, $servicesId)
  {
    foreach (get_languages() as $lang => $val) {
      ServiceTranslation::create([
        'service_id' => $servicesId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'description' => $data['description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationService($data, $service)
  {
    foreach (get_languages() as $lang => $val) {
      $serviceTranslation = ServiceTranslation::where(['service_id' => $service->id, 'language' => $lang])->first();
      $serviceTranslation->update([
        'services_id' => $service->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'description' => $data['description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
