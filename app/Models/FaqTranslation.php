<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    protected $fillable = ['faq_id', 'language', 'title', 'description', 'seo_title', 'seo_description'];
}
