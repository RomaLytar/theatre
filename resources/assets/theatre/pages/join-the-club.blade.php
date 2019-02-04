@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.description-text.description-text', ['description' => $page->translate->descriptions])

    @include('pages.theatre._blocks.contact-us.contact-us', [
      'title' => __('contact.join_to_club'),
      'titleMobile' => __('contact.join_to_club_mobile'),
      'buttonTitle' => __('contact.join'),
    ])
    @include('pages.theatre._blocks.articles.articles-support')
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
  @include('pages.theatre._blocks.popup.popup')
@endsection
