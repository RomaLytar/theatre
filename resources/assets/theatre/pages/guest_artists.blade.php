@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">

    <h1 class="page-title page-title--small">{{ $currentGroup->translate->title }}</h1>
    <div class="row section-margin-bottom">
      @if($currentGroup->actors)
        @foreach($currentGroup->actors as $actor)
          <div class="col-6 col-sm-6 col-md-4 col-xl-3 d-flex align-items-stretch">
            @include('pages.theatre._blocks.team.team-card-vertical.team-card-vertical', [
              'actor' => $actor,
              'has_merit' => false,
              'moreBtn' => true
            ])
          </div>
        @endforeach
      @endif

    </div>
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
