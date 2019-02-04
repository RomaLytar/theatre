<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends MultiLanguageModel
{
  protected $multiLanguageForeignKey = 'faq_category_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return FaqCategoryTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['title'];
  }

  public  function faqs() {
    return $this->hasMany(Faq::class, 'category_id', 'id');
  }
}
