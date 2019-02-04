<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\Season;
use App\Models\SeasonTranslation;


class SeasonRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Season';
  }

  public function createSeasons($data)
  {
    $season = [
      'number' => $data['number'],
    ];
    $season = $this->create($season);
    $this->addTranslationSeason($data, $season->id);
  }

  public function editSeason($data, $id)
  {
    $array = [
      'number' => $data['number'],
    ];
    $this->update($array, ['id' => $id]);
    $season = Season::find($id);
    $this->editTranslationSeason($data, $season);
  }

  public function addTranslationSeason($data, $seasonId)
  {
    foreach (get_languages() as $lang => $val) {
      SeasonTranslation::create([
        'season_id' => $seasonId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }

  public function editTranslationSeason($data, $season)
  {
    foreach (get_languages() as $lang => $val) {
      $seasonTranslation = SeasonTranslation::where(['season_id' => $season->id, 'language' => $lang])->first();
      $seasonTranslation->update([
        'season_id' => $season->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }
}
