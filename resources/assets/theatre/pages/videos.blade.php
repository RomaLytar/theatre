@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid" data-filter-media data-media-video>
    {{-- {{ Breadcrumbs::render('videos') }} --}}

    @include('pages.theatre._blocks.subscribe.subscribe-youtube')
    <h1 class="page-title page-title--second">{{ __('home.videos') }}</h1>
    <button class="btn-more btn-more--gold btn-more--filter" data-popup-link="filter-videos">{{ __('media.filter') }}</button>
    @include('pages.theatre._blocks.filter.filter-video')
    @include('pages.theatre._blocks.videos.videos', ['videos' => $videos])
    <section class="pagination" data-filter-pagination></section>
    {{-- {{ $videos->links('pages.theatre._blocks.pagination.pagination') }} --}}
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')

@endsection
