<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends MultiLanguageModel
{
  protected $table = 'project_cats';
  protected $multiLanguageForeignKey = 'project_cat_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return ProjectCategoryTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['title'];
  }

  public  function projects() {
    return $this->hasMany(Project::class, 'category_id', 'id');
  }
}
