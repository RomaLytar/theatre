<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentationTranslation extends Model
{
  protected $table = 'doc_translations';
  protected $fillable = ['doc_id', 'language', 'title'];
}
