<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends MultiLanguageModel
{
  protected $fillable = ['number'];

  protected $multiLanguageForeignKey = 'season_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return SeasonTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['title'];
  }

  public function albums() {
    return $this->hasMany(Album::class, 'category_id', 'id');
  }

}
