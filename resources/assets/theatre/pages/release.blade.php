@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    {{-- {{ Breadcrumbs::render('release', $article) }} --}}
    <h1 class="page-title page-title--nomobile">{{ $article->translate->title }}</h1>
    @include('pages.theatre._blocks.description-cards.description-cards', [
    'type' => 'articles',
    'item' => $article,
    'share' => true,
    'date' => false,
    'titleGold' => true
    ])
  </div>
  @include('pages.theatre._blocks.releases-media.releases-media', [
    'images' => $article->getMedia('article-images'),
    'videos' => $article->videos,
    'title' => $article->translate->title
  ])
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
