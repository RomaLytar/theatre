@extends('layouts.theatre')

@section('content')
  @include('pages.theatre._blocks.promo-info.promo-info')
  <div class="wrap container-fluid">
    <ul class="calendar-list">
      @include('pages.theatre._blocks.calendar.calendar-event.calendar-list')
      @include('pages.theatre._blocks.calendar.calendar-event.calendar-list')
      @include('pages.theatre._blocks.calendar.calendar-event.calendar-list')
      @include('pages.theatre._blocks.calendar.calendar-event.calendar-list')
    </ul>
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
</section>
@endsection

