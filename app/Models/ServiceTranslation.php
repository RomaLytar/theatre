<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTranslation extends Model
{
  protected $fillable = ['service_id', 'language', 'title', 'description', 'seo_title', 'seo_description'];
}
