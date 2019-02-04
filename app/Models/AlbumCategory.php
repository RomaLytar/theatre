<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumCategory extends MultiLanguageModel
{
    protected $multiLanguageForeignKey = 'album_category_id';
    protected $multiLanguageLocalKey = 'id';

    public function multiLanguageModel()
    {
      return AlbumCategoryTranslation::class;
    }

    public function multiLanguageFields()
    {
      return ['title'];
    }

    public function albums() {
      return $this->hasMany(Album::class, 'category_id', 'id');
    }

}
