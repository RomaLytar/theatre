<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends MultiLanguageModel
{

  protected $table = 'faq';
  protected $fillable = ['category_id'];
  protected $multiLanguageForeignKey = 'faq_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return FaqTranslation::class;
  }
  public function multiLanguageFields()
  {
    return ['title', 'description'];
  }
  public function category()
  {
    return $this->belongsTo(FaqCategory::class, 'category_id');
  }
}
