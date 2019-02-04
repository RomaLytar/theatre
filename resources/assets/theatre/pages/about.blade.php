@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    {{-- {{ Breadcrumbs::render('about') }} --}}
    <h1 class="page-title">{{ __('home.about') }}</h1>
    @include('pages.theatre._blocks.articles.articles', [
      'type' => 'articles',
      'withoutSlider' => true,
      'articles' => $articles,
      'route' => $itemRoute
    ])
    {{ $articles->links('pages.theatre._blocks.pagination.pagination') }}

    @include('pages.theatre._blocks.search-main.search-main')

  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
