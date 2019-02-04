<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentationCategory extends MultiLanguageModel
{
  protected $table = 'doc_categories';
  protected $multiLanguageForeignKey = 'doc_category_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return DocumentationCategoryTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['title'];
  }

  public  function documentations() {
    return $this->hasMany(Documentation::class, 'category_id', 'id');
  }
}
