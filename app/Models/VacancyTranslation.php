<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class VacancyTranslation extends Model
{
  use Sluggable;

  protected $fillable = ['vacancy_id', 'language', 'title', 'description', 'add_description','seo_title', 'seo_description'];
  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'title',
      ]
    ];
  }
}
