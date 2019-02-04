<?php

namespace App\Transformers\Search;

use App\Models\Article;
use League\Fractal\TransformerAbstract;


class ArticleTransform extends TransformerAbstract
{

    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'type' => 'articles',
            'title' => $article->translate->title,
            'descr' => str_limit(strip_tags($article->translate->descriptions, 300)),
            'cat' => $article->category->translate->title,
            'youtubeimg' => null,
            'img' => $article->getFirstMediaUrl('posters', 'preview'),
            'url' => route('front.articles.article', ['id' => $article->id,'slug' => $article->translate->slug]),
        ];
    }

}
