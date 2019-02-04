@extends('layouts.theatre')
@section('content')
  <section data-event>
    @include('pages.theatre._blocks.promo-info.promo-info', ['item' => $performance])
    <div class="wrap container-fluid">

      @include('pages.theatre._blocks.tabs.tabs-event')
      @include('pages.theatre._blocks.description-cards.description-cards', [
        'type' => 'performances',
        'item' => $performance,
        'share' => true,
        'title' => __('event.about_event'),
        'date' => false
      ])

      @include('pages.theatre._blocks.event.event-artists.event-artists', ['groupActorDates' => $groupActorDates])

      <div name="directors">
        @include('pages.theatre._blocks.description-cards.description-cards-directors')

      </div>

      @include('pages.theatre._blocks.media.media', [
        'album' => $performance->albums()->latest()->first(),
        'videos' => $performance->videos,
        'title' => $performance->translate->title
      ])
      @include('pages.theatre._blocks.articles.articles', [
        'type' => 'articles',
        'articles' => $performance->articles,
        'title' => __('event.articles&news'),
        'route' => 'front.articles.release',
        'more' => true,
        'routeMore' => 'front.articles.about'
      ])
      @include(
        'pages.theatre._blocks.recommend.recommend',
        ['performanceDates' => $homePageComponents[\App\Models\HomePage::RECOMMENDED_TYPE]]
      )
    </div>
    @include('pages.theatre._blocks.subscribe.subscribe')
  </section>
@endsection
