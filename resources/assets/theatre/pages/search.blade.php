@extends('layouts.theatre')

@section('content')

  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>

  <div class="wrap container-fluid" data-search-main>
    @include('pages.theatre._blocks.search-main.search-main')
    <section class="pagination" data-search-main-pagination></section>
  </div>


  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection


