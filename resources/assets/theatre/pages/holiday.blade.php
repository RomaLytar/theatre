@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @foreach($page->blocks as $block)
     @include('pages.theatre._blocks.description-text-title.description-text-title', [ 'item' => $block,
     'class' => 'description-text-title--big'])

    @if($block->attribute->name == 'gallery')
      @include('pages.theatre._blocks.gallery.gallery-holiday')
    @endif
    @endforeach
    @include('pages.theatre._blocks.contact-us.contact-us', [
    'title' => __('pages.write_to_us'),
    'titleMobile' => __('pages.write_to_us'),
    'buttonTitle' => __('pages.write')
    ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
  @include('pages.theatre._blocks.popup.popup')
@endsection
