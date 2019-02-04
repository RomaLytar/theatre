@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $project->translate->title }}</h1>
    @include('pages.theatre._blocks.description-cards.description-cards-item-contests')
    @include('pages.theatre._blocks.description-text-title.description-text-title-contests')
    @include('pages.theatre._blocks.contact-us.contact-us', [
      'title' => __('pages.participant'),
      'buttonTitle' => __('pages.contact'),
      'titleMobile' => __('pages.title_mobile'),
      ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
  @include('pages.theatre._blocks.popup.popup')
@endsection
