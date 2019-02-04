@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.description-text.description-text', [
      'class' => 'description-text--small',
      'description' => $page->translate->descriptions
    ])
    @foreach($page->blocks as $block)
      @include('pages.theatre._blocks.description-text-title.description-text-title', [
        'class' => 'description-text-title--big',
        'item' => $block
      ])
    @endforeach

    @include('pages.theatre._blocks.contact-us.contact-us', [
      'title' => __('services.contact_us'),
      'titleMobile' => __('contact.contact_us'),
      'buttonTitle' => __('contact.contacts')
    ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
  @include('pages.theatre._blocks.popup.popup')
@endsection
