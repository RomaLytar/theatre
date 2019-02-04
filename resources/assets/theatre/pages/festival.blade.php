@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    @include('pages.theatre._blocks.description-cards.description-cards', [
    'type' => 'performances',
    'item' => $festival,
    'share' => true,
    'date' => false,
    'title' => $festival->translate->title,
    ])
    @include('pages.theatre._blocks.info.info')

    @include('pages.theatre._blocks.articles.articles-representation', [
      'title' => __('home.program_of_the_festival'),
      'noFilter' => true,
      'type' => 'festivals',
      'calendars' => $festival->calendars
    ])

    @include('pages.theatre._blocks.media.media', [
      'album' => $festival,
      'videos' => $festival->videos,
      'title' => $festival->translate->title,
    ])
    @include('pages.theatre._blocks.articles.articles', [
      'title' => __('home.news_and_events'),
      'type' => 'articles',
      'articles' => $articles,
      'route' => 'front.articles.article',
    ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
