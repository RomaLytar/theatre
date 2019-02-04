
@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ __('pages.services') }}</h1>
      @include('pages.theatre._blocks.service-section.service-section')
      @include('pages.theatre._blocks.contact-us.contact-us',[
        'buttonTitle' => __('pages.feedback'),
        'title' => '',
        'titleMobile' =>''
      ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
  @include('pages.theatre._blocks.popup.popup')
@endsection

