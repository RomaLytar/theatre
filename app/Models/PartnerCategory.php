<?php

namespace App\Models;

class PartnerCategory extends MultiLanguageModel
{
  protected $multiLanguageForeignKey = 'partner_category_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return PartnerCategoryTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['title'];
  }

  public function partners() {
    return $this->hasMany(Partner::class, 'category_id', 'id');
  }

}
