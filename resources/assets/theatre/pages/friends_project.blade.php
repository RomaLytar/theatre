@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title">{{ $project->translate->title }}</h1>
    @include('pages.theatre._blocks.event.event-card.event-card')
    @include('pages.theatre._blocks.contact-us.contact-us', [
    'buttonTitle' => __('pages.join_the_club_skid_opera'),
    'title' => '',
    'titleMobile' =>''
    ])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
  @include('pages.theatre._blocks.popup.popup')
@endsection
