<?php

namespace App\Http\Controllers;

use SEO;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  public function index() {
    //
  }

  public function releases() {
    $subType = 'releases';
    $category = ArticleCategory::where('page', 'releases')->first();

    SEO::setTitle($category->translate->seo_title ? $category->translate->seo_title : $category->translate->title);
    SEO::setDescription($category->translate->seo_description);

    $articles = Article::with('translate', 'media')->where('category_id', $category->id)->paginate(9);
    $itemRoute = 'front.articles.release';

    return view('pages.theatre.pages.releases', compact('category', 'articles', 'subType', 'itemRoute'));
  }

  public function about() {
    $subType = 'about';
    $category = ArticleCategory::where('page', 'about')->first();

    SEO::setTitle($category->translate->seo_title ? $category->translate->seo_title : $category->translate->title);
    SEO::setDescription($category->translate->seo_description);

    $articles = Article::with('translate', 'media')->where('category_id', $category->id)->paginate(9);
    $itemRoute = 'front.articles.article';
//    dd($articles->links);
    return view('pages.theatre.pages.about', compact('category', 'articles', 'subType', 'itemRoute'));
  }

  public function release($id, $slug) {
    if (!$article = Article::find($id)) {
      abort(404);
    }

    if($article->translate->slug != $slug) {
      return redirect()->route('front.articles.release', ['id' => $id, 'slug' => $article->translate->slug]);
    }

    SEO::setTitle($article->translate->seo_title);
    SEO::setDescription($article->translate->seo_description);

    return view('pages.theatre.pages.release', compact('article'));
  }

  public function article($id, $slug) {
    if (!$article = Article::find($id)) {
      abort(404);
    }

    if($article->translate->slug != $slug) {
      return redirect()->route('front.articles.article', ['id' => $id, 'slug' => $article->translate->slug]);
    }

    $subType = 'about';

    $category = ArticleCategory::where('page', 'about')->first();
    $articles = Article::with('translate', 'media')->where('category_id', $category->id)->where('id', '!=', $id)->latest()->limit(3)->get();
    $moreArticles = $articles->count() >= 3 ? true : false;
    $itemRoute = 'front.articles.article';
    $moreItemsRoute = 'front.articles.about';
    $moreItemsTitle = __('pages.related_articles');


    SEO::setTitle($article->translate->seo_title);
    SEO::setDescription($article->translate->seo_description);

    return view('pages.theatre.pages.article', compact('article', 'articles', 'subType', 'moreArticles', 'itemRoute', 'moreItemsRoute', 'moreItemsTitle'));
  }
}
