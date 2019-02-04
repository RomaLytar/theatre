<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DocumentationCategory;

class Documentation extends MultiLanguageModel
{
  protected $table = 'docs';
  protected $fillable = ['category_id','file'];
  protected $multiLanguageForeignKey = 'doc_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return DocumentationTranslation::class;
  }
  public function multiLanguageFields()
  {
    return ['title'];
  }
  public function category()
  {
    return $this->belongsTo(DocumentationCategory::class, 'category_id');
  }
  protected function documentation() {
    return $this->hasMany(Documentation::class, 'doc_id', 'id');
  }
  public function shortDescription($сharacterNumber) {
    return str_limit($this->translate->title, $сharacterNumber);
  }
}
