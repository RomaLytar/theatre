@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.text-block.text-block)
    @include('pages.theatre._blocks.articles.articles-abonement', [
      'type' => 'articles',
      'articles' => $articles,
      'title' => __('event.articles&news'),
      'route' => 'front.articles.release'
    ])
    @include('pages.theatre._blocks.text-block.text-block)
    @include('pages.theatre._blocks.call-us.call-us)



  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection


{{-- Вова, когда подвяжешь эту страницу, отдай ее на доработку и проверку фронтенду. Делал в слепую. Поэтому может быть несоответствие с макетом. Искренне ваш, поручик Ржевский}}
