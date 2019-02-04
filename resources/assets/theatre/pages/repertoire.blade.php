@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title">{{ __('event.repertoire') }}</h1>
    <button class="btn-more btn-more--gold btn-more--filter" data-popup-link="filter-repertoire">{{ __('media.filter') }}</button>
    @include('pages.theatre._blocks.filter.filter-repertoire')
    @include('pages.theatre._blocks.articles.articles', [
      'type' => 'events',
      'withoutSlider' => true,
      'items' => $events,
      'route' => 'front.events.show'
    ])
  </div>
  {{ $events->links('pages.theatre._blocks.pagination.pagination') }}

  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
