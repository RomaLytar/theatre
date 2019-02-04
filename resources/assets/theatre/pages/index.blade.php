@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @if(isset($homePageComponents[\App\Models\HomePage::PROMO_SLIDER_TYPE]))
      @include(
        'pages.theatre._blocks.promo-slider.promo-slider',
        ['performanceDates' => $homePageComponents[\App\Models\HomePage::PROMO_SLIDER_TYPE]]
      )
    @endif
    @include(
      'pages.theatre._blocks.performances.performances',
      ['performanceDates' => $homePageComponents[\App\Models\HomePage::PROMO_SLIDER_MINI_TYPE] ?? '']
    )
  </div>

  <div class="wrap container-fluid">
     @include('pages.theatre._blocks.articles.articles-representation', ['performances' => $performances])

    @if(isset($homePageComponents[\App\Models\HomePage::RECOMMENDED_TYPE]))
      @include(
        'pages.theatre._blocks.recommend.recommend',
        ['performanceDates' => $homePageComponents[\App\Models\HomePage::RECOMMENDED_TYPE]]
      )
    @endif

    @include(
    'pages.theatre._blocks.articles.articles',
    ['type' => 'articles', 'route' => 'front.articles.release', 'title' => __('home.articles&news'), 'more' => true, 'routeMore' => 'front.articles.about'])

    @if(isset($homePageComponents[\App\Models\HomePage::SPECIAL_PROJECTS_TYPE]))
      @include(
        'pages.theatre._blocks.special-projects.special-projects',
        ['performanceDates' => $homePageComponents[\App\Models\HomePage::SPECIAL_PROJECTS_TYPE]]
      )
    @endif
  </div>

  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
