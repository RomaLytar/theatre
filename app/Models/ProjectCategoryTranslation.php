<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCategoryTranslation extends Model
{
  protected $table = 'project_cat_translations';
  protected $fillable = ['project_cat_id', 'language', 'title'];
}
