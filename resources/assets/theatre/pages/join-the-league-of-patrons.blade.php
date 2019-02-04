@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.description-text.description-text', ['description' => $page->translate->descriptions])
    @foreach($page->blocks as $block)
      @include('pages.theatre._blocks.description-text-title.description-text-title', [
      'class' => 'description-text-title--big',
      'item' => $block
      ])
    @endforeach

    @include('pages.theatre._blocks.contact-us.contact-us', [
      'title' => __('contact.join_to_the_league'),
      'titleMobile' => __('contact.join_to_the_league_mobile'),
      'buttonTitle' => __('contact.join_add'),
    ])
    @include('pages.theatre._blocks.articles.articles', [
      'type' => 'join_the_league',
      'articles' => $projects,
      'title' => __('pages.support_join'),
      'route' => 'front.projects.show',
    ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
  @include('pages.theatre._blocks.popup.popup')
@endsection
