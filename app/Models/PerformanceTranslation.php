<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class PerformanceTranslation extends Model
{
  use Sluggable;

  protected $fillable = ['performance_id',
      'language',
      'title',
      'lang',
      'descriptions',
      'directors',
      'directors2',
      'author',
      'seo_title',
      'seo_description',
      'synapsis',
      'program',
      'city',
      'place',
      'tagline'];

  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'title',
      ]
    ];
  }

}
