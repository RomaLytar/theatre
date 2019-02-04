
@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
      <h1 class="page-title page-title--small">{{ __('pages.vacancy_job') }}</h1>
      @include('pages.theatre._blocks.description-text-title.description-text-title-vacancy')
      @include('pages.theatre._blocks.form-vacancy.form-vacancy')
  </div>

  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
