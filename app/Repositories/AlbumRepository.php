<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 6/04/2018
 * Time: 2:16 PM
 */

namespace App\Repositories;
use App\Models\AlbumTranslation;

class AlbumRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Album';
  }

  public function createAlbums($data)
  {
    $album = [
      'category_id' => $data['category_id'],
      'season_id' => $data['season_id'],
    ];
    $album = $this->create($album);
    $this->addTranslationAlbum($data, $album);
    if(isset($data['actors'])){
    $this->addActorsToAlbum($data['actors'], $album);
    }
    if(isset($data['performances'])){
    $this->addPerformancesToAlbum($data['performances'], $album);
    }
    return $album;
  }

  public function addActorsToAlbum($actors, $album) {
    foreach ($actors as $actorId) {
      $album->actors()->attach($actorId);
    }
  }

  public function addPerformancesToAlbum($performances, $album) {
    foreach ($performances as $performanceId) {
      $album->performances()->attach($performanceId);
    }
  }

  public function editAlbum($data, $album)
  {
    $array = [
      'category_id' => $data['category_id'],
      'season_id' => $data['season_id'],
    ];
    $this->update($array, ['id' => $album->id]);
    $this->editTranslationAlbum($data, $album);

    $album->actors()->detach();
    if(isset($data['actors'])) {
      $this->addActorsToAlbum($data['actors'], $album);
    }
    $album->performances()->detach();
    if(isset($data['performances'])) {
      $this->addPerformancesToAlbum($data['performances'], $album);
    }
  }

  public function addTranslationAlbum($data, $album)
  {
    foreach(get_languages() as $lang => $val) {
      AlbumTranslation::create([
        'album_id' => $album->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationAlbum($data, $album)
  {
    foreach(get_languages() as $lang => $val) {
      $albumTranslation = AlbumTranslation::where(['album_id' => $album->id, 'language' => $lang])->first();
      $albumTranslation->update([
        'album_id' => $album->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
