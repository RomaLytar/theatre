@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ __('pages.faq') }}</h1>
    @include('pages.theatre._blocks.faq.faq')
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
