<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramTranslation extends Model
{
  protected $fillable = ['program_id', 'language', 'title', 'description', 'terms_description', 'seo_title', 'seo_description'];
}
