@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.description-cards.description-cards', [
      'type' => 'performances',
      'item' => $page,
      'date' => false,
      'share' => true,
    ])
    @include('pages.theatre._blocks.articles.articles-representation', [
      'title' => __('home.upcoming_events_of_the_season'),
      'noFilter' => true,
      'calendars' => $events
    ])

    @include('pages.theatre._blocks.gallery.events-gallery')

    @include('pages.theatre._blocks.articles.articles', [
      'type' => 'articles',
      'articles' => $articles,
      'title' => __('event.articles&news'),
      'route' => 'front.articles.release'
    ])

  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
