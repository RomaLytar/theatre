@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>

    @include('pages.theatre._blocks.description-text.description-text',['description' => $page->shortDescription(483),
    'class'=> 'description-text--small'])

    @include('pages.theatre._blocks.articles.articles-events', [ 'titleButton' => __('home.all_day_news')])

    @foreach ($page->blocks as $block)
      @if($block->attribute->name == 'link')
        @include('pages.theatre._blocks.video-promo.video-promo',['url' => $block->translate->descriptions])
      @endif
    @endforeach


    @php ($i=0)
    @foreach ($page->blocks as $block)
      @if($block->attribute->name == 'description')
      <h2 class="visit-title">{{ $block->translate->title }}</h2>
    @include('pages.theatre._blocks.description-cards.description-cards-item-where-to-go')
      @endif
    @php ($i++)
      @if($i == 1)

        @include('pages.theatre._blocks.articles.articles-exhibitions')

      @endif
    @endforeach

    @include('pages.theatre._blocks.articles.articles-recommended')

  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
