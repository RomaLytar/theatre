@extends('layouts.theatre')

@section('content')
  @include('pages.theatre._blocks.promo-calendar.promo-calendar', [
    'title' => __('calendar.calendar'),
  ])
  @include('pages.theatre._blocks.calendar.calendar')
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
