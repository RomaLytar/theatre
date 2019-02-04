<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
  protected $fillable = ['country_id', 'language', 'title'];

  public $timestamps = false;
}
