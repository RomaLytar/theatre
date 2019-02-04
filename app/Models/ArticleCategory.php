<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends MultiLanguageModel
{
    protected $fillable = ['page'];
    protected $multiLanguageForeignKey = 'article_category_id';
    protected $multiLanguageLocalKey = 'id';

    public function multiLanguageModel()
    {
      return ArticleCategoryTranslation::class;
    }

    public function multiLanguageFields()
    {
      return ['title'];
    }

    protected function articles() {
      return $this->hasMany(Article::class, 'category_id', 'id');
    }
}
