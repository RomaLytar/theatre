@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.description-text.description-text', ['description' => $page->translate->descriptions ])
    @foreach($page->blocks as $block)
      @include('pages.theatre._blocks.download-link.download-link', [
        'title' => $block->translate->title,
        'url' => $block->translate->descriptions,
      ])
    @endforeach
    @include('pages.theatre._blocks.contact-us.contact-us', [
      'title' => __('contact.have_any_questions') . ' ' . __('contact.contacts_us'),
      'titleMobile' => __('contact.contact_us'),
      'buttonTitle' => __('contact.contacts'),
    ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
  @include('pages.theatre._blocks.popup.popup')
@endsection

