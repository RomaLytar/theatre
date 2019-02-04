<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategoryTranslation extends Model
{
  protected $fillable = ['faq_category_id', 'language', 'title'];

}
