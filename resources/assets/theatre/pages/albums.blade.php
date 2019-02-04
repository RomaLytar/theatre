@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid" data-filter-media>
    {{-- {{ Breadcrumbs::render('albums') }} --}}
    <h1 class="page-title">{{ __('home.photos') }}</h1>
     <button class="btn-more btn-more--gold btn-more--filter" data-popup-link="filter-albums">{{ __('media.filter') }}</button>
    @include('pages.theatre._blocks.filter.filter')
    @include('pages.theatre._blocks.albums.albums', ['albums' => $albums])
    <section class="pagination" data-filter-pagination></section>
    {{-- {{ $albums->links('pages.theatre._blocks.pagination.pagination') }} --}}
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
