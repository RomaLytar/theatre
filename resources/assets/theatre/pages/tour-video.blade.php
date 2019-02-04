@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ __('pages.opera_tour') }}</h1>
    @include('pages.theatre._blocks.tabs.tabs-visit')
    @foreach($page->blocks as $block)
      <h2 class="media__title">{{ $block->translate->title }}</h2>
      @include('pages.theatre._blocks.video-promo.video-promo', ['url' => $block->translate->descriptions])
    @endforeach
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
