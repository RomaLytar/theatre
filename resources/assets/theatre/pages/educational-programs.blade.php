@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.description-text.description-text', ['description' => $page->translate->descriptions])
    @include('pages.theatre._blocks.description-cards.description-cards-educations', [
      'route' => 'front.projects.show',
      'projects' => $projects,
    ])
    {{ $projects->links('pages.theatre._blocks.pagination.pagination') }}
    @include('pages.theatre._blocks.articles.articles', [
      'title' => __('home.articles&news'),
      'route' => 'front.articles.about',
      'type' => 'articles', 'articles' => $articles
    ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection

