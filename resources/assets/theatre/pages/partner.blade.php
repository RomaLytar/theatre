@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $partner->translate->title }}</h1>
    @include('pages.theatre._blocks.description-cards.description-cards-simple', [
      'hasTitle' => false,
      'description' => $partner->translate->descriptions,
      'imageUrl' => $partner->getFirstMediaUrl('posters')
    ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
