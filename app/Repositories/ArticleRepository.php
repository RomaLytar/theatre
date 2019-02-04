<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 6/04/2018
 * Time: 2:16 PM
 */

namespace App\Repositories;
use App\Models\Actor;
use App\Models\Article;
use App\Models\ArticleActor;
use App\Models\ArticlePerformance;
use App\Models\ArticleTranslation;
use App\Models\Performance;

class ArticleRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Article';
  }

  public function createArticles($data)
  {
    $article = [
      'category_id' => $data['category_id'],
    ];

    $article = $this->create($article);
    if(isset($data['videos'])){
      $this->addVideosToArticle($data['videos'], $article);
    }
    $this->addTranslationArticle($data, $article);
    if(isset($data['actors'])) {
      $this->addActorsToArticle($data['actors'], $article);
    }
    if(isset($data['performances'])) {
      $this->addPerformancesToArticle($data['performances'], $article);
    }
    return $article;
  }

  public function addVideosToArticle($videos, $article)
  {
    foreach ($videos as $video) {
      $article->videos()->attach($video->id);
    }
  }

  public function changeVideos(Article $article, $data)
  {
    if (isset($data['videos'])) {
      foreach ($article->videos as $video) {
        $video->delete();
      }
      $this->addVideosToArticle($data['videos'], $article->id);
    }
  }

  public function addActorsToArticle($actors, $article) {
    foreach ($actors as $actorId) {
      $article->actors()->attach($actorId);
    }
  }

  public function addPerformancesToArticle($performances, $article) {
    foreach ($performances as $performanceId) {
      $article->performances()->attach($performanceId);
    }
  }

  public function editArticle($data, $article)
  {
    $array = [
      'category_id' => $data['category_id'],
    ];
    $this->update($array, ['id' => $article->id]);
    $this->editTranslationArticle($data, $article);
    $article->actors()->detach();
    if(isset($data['actors'])) {
      $this->addActorsToArticle($data['actors'], $article);
    }
    $article->performances()->detach();
    if(isset($data['performances'])) {
      $this->addPerformancesToArticle($data['performances'], $article);
    }
//    dd($data['videos']);
    $this->addVideosToArticle($data['videos'], $article);
  }

  public function addTranslationArticle($data, $article)
  {
    foreach(get_languages() as $lang => $val) {
      ArticleTranslation::create([
        'article_id' => $article->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'descriptions' => $data['descriptions_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }

  public function editTranslationArticle($data, $article)
  {
    foreach(get_languages() as $lang => $val) {
      $articleTranslation = ArticleTranslation::where(['article_id' => $article->id, 'language' => $lang])->first();
      $articleTranslation->update([
        'article_id' => $article->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
        'descriptions' => $data['descriptions_' . $lang],
        'seo_title' => $data['seo_title_' . $lang],
        'seo_description' => $data['seo_description_' . $lang],
      ]);
    }
  }
}
