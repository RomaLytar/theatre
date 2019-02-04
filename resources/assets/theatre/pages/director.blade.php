@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    @include('pages.theatre._blocks.description-cards.description-cards-team', [
    'hasTitle' => false,
    'hasMerit' => true,
    'actor' => $actor
    ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')

@endsection
