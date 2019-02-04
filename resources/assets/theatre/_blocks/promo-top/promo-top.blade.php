<div class="wrap container-fluid promo-top">
    @foreach(session('banners') as $banner)
        @if($banner->is_calendar != 1)
      <p class="col col-xl-8 col-md-6 col-sm-12 promo-top__name"> {{ $banner->translate->title }} </p>
        @endif
    @endforeach
  <div class="col col-xl-4 col-md-6 col-sm-12 promo-top__calendar">
    @include('pages.theatre._blocks.calendar-btn.calendar-btn')
  </div>
</div>
