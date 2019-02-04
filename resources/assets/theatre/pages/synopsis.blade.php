@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">
      <span class="page-title__mob-black">{{ __('event.synopsis') }}:</span>
      {{ $performance->translate->title }}</h1>
    @include('pages.theatre._blocks.description-cards.description-cards-event', ['item' => $performance])

    @include('pages.theatre._blocks.text-block.text-block', ['descriptions' => $performance->translate->synapsis])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
