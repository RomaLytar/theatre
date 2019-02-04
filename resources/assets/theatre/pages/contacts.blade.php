@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small" data-mob-map-innit>{{ $page->translate->title }}</h1>
    <div class="row articles__row" data-mail-to-container>
      @foreach($page->blocks as $block)
        <div class="col-md-6 col-xl-4">
          @include('pages.theatre._blocks.info-block.info-block', ['item' => $block])
        </div>
      @endforeach
    </div>
    @include('pages.theatre._blocks.contact-us.contact-us', [
      'title' => __('contact.write_us'),
      'titleMobile' => __('contact.write_us'),
      'buttonTitle' => __('contact.write'),
    ])
    <div data-map-parent>
      @include('pages.theatre._blocks.map.map')
    </div>
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
  @include('pages.theatre._blocks.popup.popup')
@endsection

