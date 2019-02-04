<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeasonTranslation extends Model
{
  protected $fillable = ['season_id', 'language', 'title'];
}
