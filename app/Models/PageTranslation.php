<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    use Sluggable;

    protected $fillable = ['page_id', 'language', 'title', 'descriptions', 'seo_title', 'seo_description'];

    public function sluggable()
    {
      return [
        'slug' => [
          'source' => 'title',
        ]
      ];
    }
}
