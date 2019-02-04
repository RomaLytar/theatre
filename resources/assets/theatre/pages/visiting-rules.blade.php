@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.description-cards.description-cards-only-text', ['items' => $page->blocks])
    <div class="wrap__center">
      <a href="{{ setting(session('locale') . '.' . 'instagram') }}" class="btn-more btn-more--long btn-more--uppercase btn-more--gold btn-more--last">{{ __('pages.see_instagram') }}</a>
    </div>
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection





