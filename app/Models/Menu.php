<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends MultiLanguageModel
{
  protected $fillable = ['url', 'position', 'parent_id'];
  protected $multiLanguageForeignKey = 'menu_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return MenuTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['menu'];
  }

  public function children_items() {
    return $this->hasMany(Menu::class, 'parent_id', 'id');
  }
}
