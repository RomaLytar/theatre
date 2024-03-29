@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title">{{ $page->translate->title }}</h1>

    <section data-event-premier>
      @include('pages.theatre._blocks.filter.filter-premier')
      <div data-event-premier-list>
        @include('pages.theatre._blocks.articles.articles', [
          'type' => 'eventSchedule',
          'events' => $events,
          'route' => 'front.events.show',
        ])
      </div>
    </section>

    {{--@foreach($page->blocks as $block)--}}
      {{--@if($block->attribute->name === 'gallery')--}}
        @include('pages.theatre._blocks.gallery.events-gallery')
      {{--@endif--}}
    {{--@endforeach--}}

    @include('pages.theatre._blocks.articles.articles', [
      'type' => 'articles',
      'articles' => $articles,
      'title' => __('event.articles&news'),
      'route' => 'front.articles.release'
    ])

  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
