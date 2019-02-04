@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @set($i, 0)
    @foreach($page->blocks as $block)
      @include('pages.theatre._blocks.description-text-title.description-text-title', ['item' => $block])
      @if($i === 0)
        {{--@include('pages.theatre._blocks.articles.articles-abonement', [--}}
        {{--'type' => 'articles',--}}
        {{--'articles' => $articles,--}}
        {{--'title' => __('event.articles&news'),--}}
        {{--'route' => 'front.articles.release'--}}
        {{--])--}}
      @endif
      @set($i, $i+1)
    @endforeach

  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
