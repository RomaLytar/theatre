<?php

use Illuminate\Database\Seeder;

class ArticleCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
          'releases',
          'about',
          'offstage',
          'exhibitions',
        ];
        foreach($categories as $category) {
          factory(\App\Models\ArticleCategory::class, 'article_category', 1)->create(['page' => $category])->each(function($article_category) use ($category) {
            $article_category->translate('en')->save(factory(\App\Models\ArticleCategoryTranslation::class, 'article_category_en')->create(['article_category_id' => $article_category->id, 'title' => $category]));
            $article_category->translate('ru')->save(factory(\App\Models\ArticleCategoryTranslation::class, 'article_category_ru')->create(['article_category_id' => $article_category->id, 'title' => $category]));
            $article_category->translate('ua')->save(factory(\App\Models\ArticleCategoryTranslation::class, 'article_category_ua')->create(['article_category_id' => $article_category->id, 'title' => $category]));
          });
        }
    }
}
