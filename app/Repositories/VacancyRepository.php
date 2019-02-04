<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\Vacancy;
use App\Models\VacancyTranslation;



class VacancyRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Vacancy';
  }

  public function createVacancy($data)
  {
    $vacancy = [
      'is_active' => $data['is_active'] ?? null
    ];
    $vacancy = $this->create($vacancy);
    $this->addTranslationVacancy($data, $vacancy->id);
    return $vacancy;
  }

  public function editVacancy($data, $id)
  {
    $array = [
      'is_active' => $data['is_active'] ?? null
    ];
    $this->update($array, ['id' => $id]);
    $vacancy = Vacancy::find($id);
    $this->editTranslationVacancy($data, $vacancy);
  }

  public function addTranslationVacancy($data, $vacancyId)
  {
    foreach (get_languages() as $lang => $val) {
      VacancyTranslation::create([
        'vacancy_id' => $vacancyId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'description' => $data['description_' . $lang],
        'add_description' => $data['add_description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationVacancy($data, $vacancy)
  {
    foreach (get_languages() as $lang => $val) {
      $vacancyTranslation = VacancyTranslation::where(['vacancy_id' => $vacancy->id, 'language' => $lang])->first();
      $vacancyTranslation->update([
        'vacancy_id' => $vacancy->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'description' => $data['description_' . $lang],
        'add_description' => $data['add_description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
