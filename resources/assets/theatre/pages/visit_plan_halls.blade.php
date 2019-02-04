@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>

    @include('pages.theatre._blocks.tabs.tabs-visit-plan')

    <section class="visit-img">
      <!-- Размер картинки указан 812x410 -->
      <img src="{{ $page->getFirstMediaUrl('posters') }}" alt="{{ $page->translate->title }}">
    </section>

    <!-- Заголовок "Наши залы" -->
    @foreach($page->blocks as $item)
     @include('pages.theatre._blocks.description-text-title.description-text-title', ['item' => $item])
    @endforeach
    <!--  -->
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
