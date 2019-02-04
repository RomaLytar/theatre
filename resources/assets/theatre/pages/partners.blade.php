@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ __('pages.partners_sponsors') }}</h1>
    @foreach($mainPartners as $partner)
      @include('pages.theatre._blocks.description-cards.description-cards-partner', ['item' => $partner])
    @endforeach
    @include('pages.theatre._blocks.partners.partners', ['partners' => $middlePartners])
    @include('pages.theatre._blocks.partners.partners-low', ['partners' => $otherPartners])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
