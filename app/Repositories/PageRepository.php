<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 6/04/2018
 * Time: 2:16 PM
 */

namespace App\Repositories;
use App\Models\Actor;
use App\Models\Page;
use App\Models\PageActor;
use App\Models\PagePerformance;
use App\Models\PageTranslation;
use App\Models\Performance;

class PageRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Page';
  }

  public function createPages($data)
  {
    $page = [
      'name' => $data['name'],
    ];

    $page = $this->create($page);
    if(isset($data['videos'])){
      $this->addVideosToPage($data['videos'], $page);
    }
    $this->addTranslationPage($data, $page);
    return $page;
  }

  public function editPage($data, $page)
  {

    $array = [
      'name' => $data['name'],
    ];
    $this->update($array, ['id' => $page->id]);
    $this->editTranslationPage($data, $page);
  }

  public function addTranslationPage($data, $page)
  {
    foreach(get_languages() as $lang => $val) {
      PageTranslation::create([
        'page_id' => $page->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'descriptions' => $data['descriptions_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationPage($data, $page)
  {
    foreach(get_languages() as $lang => $val) {
      $pageTranslation = PageTranslation::where(['page_id' => $page->id, 'language' => $lang])->first();
      $pageTranslation->update([
        'page_id' => $page->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'descriptions' => $data['descriptions_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
