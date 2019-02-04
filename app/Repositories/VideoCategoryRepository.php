<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\VideoCategory;
use App\Models\VideoCategoryTranslation;


class VideoCategoryRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\VideoCategory';
  }

  public function createVideoCategories($data)
  {
    $videoCategory = [];
    $videoCategory = $this->create($videoCategory);
    $this->addTranslationVideoCategory($data, $videoCategory->id);
  }

  public function editVideoCategory($data, $id)
  {
    $array = [];
    $this->update($array, ['id' => $id]);
    $videoCategory = VideoCategory::find($id);
    $this->editTranslationVideoCategory($data, $videoCategory);
  }

  public function addTranslationVideoCategory($data, $videoCategoryId)
  {
    foreach (get_languages() as $lang => $val) {
      VideoCategoryTranslation::create([
        'video_category_id' => $videoCategoryId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationVideoCategory($data, $videoCategory)
  {
    foreach (get_languages() as $lang => $val) {
      $videoCategoryTranslation = VideoCategoryTranslation::where(['video_category_id' => $videoCategory->id, 'language' => $lang])->first();
      $videoCategoryTranslation->update([
        'video_category_id' => $videoCategory->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
