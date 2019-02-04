@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">Наблюдательный совет</h1>
    <section class="inform-orders">
      @include('pages.theatre._blocks.tabs.tabs-inform-orders')
      @include('pages.theatre._blocks.inform-orders.inform-orders')
    </section>
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
