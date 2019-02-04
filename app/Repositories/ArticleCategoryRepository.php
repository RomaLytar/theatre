<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/31/2018
 * Time: 6:16 PM
 */

namespace App\Repositories;
use App\Models\ArticleCategory;
use App\Models\ArticleCategoryTranslation;


class ArticleCategoryRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\ArticleCategory';
  }

  public function createArticleCategories($data)
  {
    $articleCategory = [
      'page' => $data['page'],
    ];
    $articleCategory = $this->create($articleCategory);
    $this->addTranslationArticleCategory($data, $articleCategory->id);
  }

  public function editArticleCategory($data, $id)
  {
    $array = [
      'page' => $data['page'],
    ];
    $this->update($array, ['id' => $id]);
    $articleCategory = ArticleCategory::find($id);
    $this->editTranslationArticleCategory($data, $articleCategory);
  }

  public function addTranslationArticleCategory($data, $articleCategoryId)
  {
    foreach (get_languages() as $lang => $val) {
      ArticleCategoryTranslation::create([
        'article_category_id' => $articleCategoryId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationArticleCategory($data, $articleCategory)
  {
    foreach (get_languages() as $lang => $val) {
      $articleCategoryTranslation = ArticleCategoryTranslation::where(['article_category_id' => $articleCategory->id, 'language' => $lang])->first();
      $articleCategoryTranslation->update([
        'article_category_id' => $articleCategory->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
