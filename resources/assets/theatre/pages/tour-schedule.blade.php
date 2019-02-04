@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title">{{ $page->translate->title }}</h1>

    @include('pages.theatre._blocks.articles.articles-tour', [
      'type' => 'eventSchedule',
      'events' => $events,
      'isTour' => true,
    ])

    @foreach($page->blocks as $block)
      @if($block->attribute->name === 'gallery')
        @include('pages.theatre._blocks.media.media', [
        'className' => 'media--tour',
        'withoutAlbum' => 'data-media-without-album',
        'counterOff' => true,
        'album' => $block,
        'title' => $block->translate->title
      ])
      @endif
    @endforeach

    @include('pages.theatre._blocks.articles.articles', [
      'type' => 'articles',
      'articles' => $articles,
      'title' => __('event.articles&news'),
      'route' => 'front.articles.release'
    ])

  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection

