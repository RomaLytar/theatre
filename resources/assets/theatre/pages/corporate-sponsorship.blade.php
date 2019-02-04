@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.description-text.description-text', ['description' => $page->translate->descriptions])
    @foreach($page->blocks as $block)
      @include('pages.theatre._blocks.description-text-title.description-text-title', ['item' => $block])
    @endforeach
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
