<?php
/**
 * Created by PhpStorm.
 * User: Alteran
 * Date: 15.08.2018
 * Time: 10:51
 */


namespace App\Repositories;
use App\Models\Project;
use App\Models\ProjectTranslation;


class ProjectRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Project';
  }

  public function createProject($data)
  {
    $project = [
      'category_id' => $data['category_id'],
    ];
    $project = $this->create($project);
    $this->addTranslationProject($data, $project->id);
    return $project;
  }

  public function editProject($data, $id)
  {
    $array = [
      'category_id' => $data['category_id'],
    ];
    $this->update($array, ['id' => $id]);
    $projectCategory = Project::find($id);
    $this->editTranslationProject($data, $projectCategory);
  }

  public function addTranslationProject($data, $projectId)
  {
    foreach (get_languages() as $lang => $val) {
      ProjectTranslation::create([
        'project_id' => $projectId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'cond_description' => $data['cond_description_' . $lang],
        'description' => $data['description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationProject($data, $project)
  {
    foreach (get_languages() as $lang => $val) {
      $projectTranslation = ProjectTranslation::where(['project_id' => $project->id, 'language' => $lang])->first();
      $projectTranslation->update([
        'project_id' => $project->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'cond_description' => $data['cond_description_' . $lang],
        'description' => $data['description_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}

