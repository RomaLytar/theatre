<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\ProjectCategory;
use App\Models\ProjectCategoryTranslation;



class ProjectCategoryRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\ProjectCategory';
  }

  public function createProjectCategories($data)
  {
    $projectCategory = [
    ];
    $projectCategory = $this->create($projectCategory);
    $this->addTranslationProjectCategory($data, $projectCategory->id);
  }

  public function editProjectCategory($data, $id)
  {
    $array = [
    ];
    $this->update($array, ['id' => $id]);
    $projectCategory = ProjectCategory::find($id);
    $this->editTranslationProjectCategory($data, $projectCategory);
  }

  public function addTranslationProjectCategory($data, $projectCategoryId)
  {
    foreach (get_languages() as $lang => $val) {
      ProjectCategoryTranslation::create([
        'project_cat_id' => $projectCategoryId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }

  public function editTranslationProjectCategory($data, $projectCategory)
  {
    foreach (get_languages() as $lang => $val) {
      $projectCategoryTranslation = ProjectCategoryTranslation::where(['project_cat_id' => $projectCategory->id, 'language' => $lang])->first();
      $projectCategoryTranslation->update([
        'project_cat_id' => $projectCategory->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }
}
