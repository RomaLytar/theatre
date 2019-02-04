<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class DocumentationCategoryTranslation extends Model
{
  use Sluggable;

  protected $table = 'doc_category_translations';
  protected $fillable = ['doc_category_id', 'language', 'title'];
  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'title',
      ]
    ];
  }
}
