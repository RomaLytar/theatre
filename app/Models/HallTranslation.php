<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class HallTranslation extends Model
{
  use Sluggable;
  protected $fillable = ['hall_id', 'language','title','description','seo_title', 'seo_description'];
  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'title',
      ]
    ];
  }
}
