@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @foreach($page->blocks as $block)
      @include('pages.theatre._blocks.video-promo.video-promo', ['url' => $block->translate->descriptions])
    @endforeach
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
