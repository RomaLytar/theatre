@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    {{-- {{ Breadcrumbs::render('article', $article) }} --}}
    <h1 class="page-title page-title--nomobile">{{ __('home.about') }}</h1>
    @include('pages.theatre._blocks.description-cards.description-cards', [
      'type' => 'articles',
      'title' => $article->translate->title ,
      'item' => $article,
      'date' => true,
      'share' => true,
      'titleGold' => true
    ])
    @include('pages.theatre._blocks.articles.articles', [
      'type' => 'articles', 'articles' => $articles,
      'more' => $moreArticles,
      'route' => $itemRoute, 'routeMore' => $moreItemsRoute, 'title' => $moreItemsTitle])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
