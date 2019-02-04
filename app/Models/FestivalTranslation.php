<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class FestivalTranslation extends Model
{
  use Sluggable;
  
  protected $fillable = ['language', 'title', 'descriptions', 'festival_id', 'invited_stars', 'seo_title', 'seo_description'];
  
  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'title',
      ]
    ];
  }
}
