<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\AlbumCategory;
use App\Models\AlbumCategoryTranslation;


class AlbumCategoryRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\AlbumCategory';
  }

  public function createAlbumCategories($data)
  {
    $albumCategory = [];
    $albumCategory = $this->create($albumCategory);
    $this->addTranslationAlbumCategory($data, $albumCategory->id);
  }

  public function editAlbumCategory($data, $id)
  {
    $array = [];
    $this->update($array, ['id' => $id]);
    $albumCategory = AlbumCategory::find($id);
    $this->editTranslationAlbumCategory($data, $albumCategory);
  }

  public function addTranslationAlbumCategory($data, $albumCategoryId)
  {
    foreach (get_languages() as $lang => $val) {
      AlbumCategoryTranslation::create([
        'album_category_id' => $albumCategoryId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationAlbumCategory($data, $albumCategory)
  {
    foreach (get_languages() as $lang => $val) {
      $albumCategoryTranslation = AlbumCategoryTranslation::where(['album_category_id' => $albumCategory->id, 'language' => $lang])->first();
      $albumCategoryTranslation->update([
        'album_category_id' => $albumCategory->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
