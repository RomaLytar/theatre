@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    {{-- {{ Breadcrumbs::render('releases') }} --}}
    <h1 class="page-title">{{ __('home.releases') }}</h1>
    @include('pages.theatre._blocks.articles.articles', [
      'type' => 'articles',
      'withoutSlider' => true,
      'articles' => $articles,
      'route' => $itemRoute
      ])
    {{ $articles->links('pages.theatre._blocks.pagination.pagination') }}
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')

@endsection
