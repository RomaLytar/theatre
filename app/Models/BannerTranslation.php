<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    protected $fillable = ['banner_id', 'language', 'title'];
}
