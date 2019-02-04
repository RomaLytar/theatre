<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ProjectTranslation extends Model
{
  use Sluggable;

  protected $table = 'project_translations';
  protected $fillable = ['project_id', 'language', 'title','cond_description', 'description','seo_title', 'seo_description'];
  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'title',
      ]
    ];
  }
}
