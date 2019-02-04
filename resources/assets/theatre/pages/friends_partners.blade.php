@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title">{{ __('pages.partners_sponsors') }}</h1>
    <div class="row section-margin-bottom">
      <h1 class="page-title">{{ __('pages.partners_sponsors') }}</h1>
    </div>
    @include('pages.theatre._blocks.description-partner.description-partner')
    @include('pages.theatre._blocks.description-partner.description-partner')
    @include('pages.theatre._blocks.partners.partners')
    @include('pages.theatre._blocks.partners.partners-low')
  </div>
  {{ dd('rtr') }}
  {{-- @include('pages.theatre._blocks.pagination.pagination') --}} {{-- error--}}
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
