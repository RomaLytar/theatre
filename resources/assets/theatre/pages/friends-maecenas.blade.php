@extends('layouts.theatre')
@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.description-text.description-text', ['description' => $page->shortDescription(483)])
    @include('pages.theatre._blocks.articles.articles-maecenas', [
      'title' => __('pages.supportOpera')
    ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
