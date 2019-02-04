<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Article::class, 'article', 5)->create()->each(function($article) {
            $article->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('posters');
            for($i = 0; $i < rand(1,4); $i++) {
                $article->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('article-images');
            }
            $article->videos()->save(factory(\App\Models\Video::class, 'article')->make());
            $article->videos()->save(factory(\App\Models\Video::class, 'article')->make());
            $article->translate('en')->save(factory(\App\Models\ArticleTranslation::class, 'article_en')->make());
            $article->translate('ru')->save(factory(\App\Models\ArticleTranslation::class, 'article_ru')->make());
            $article->translate('ua')->save(factory(\App\Models\ArticleTranslation::class, 'article_ua')->make());
        });

        factory(\App\Models\ArticleActor::class, 'article', 10)->create();
        factory(\App\Models\ArticlePerformance::class, 'article', 10)->create();
    }
}
