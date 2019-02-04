@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.description-text.description-text',['description' => $page->translate->descriptions])
    @include('pages.theatre._blocks.description-links.description-links')
    @include('pages.theatre._blocks.contact-us.contact-us',[
    'buttonTitle' => __('pages.feedback'),
    'title' => __('contact.contacts_us'),
    'titleMobile' => __('contact.contacts_us')
    ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
  @include('pages.theatre._blocks.popup.popup')
@endsection

