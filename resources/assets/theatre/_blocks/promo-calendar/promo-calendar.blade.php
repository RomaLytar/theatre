<section class="promo-calendar">
  <h1 class="visually-hidden">{{ $title ?? __('home.title') }}</h1>
  <div class="wrap">
    <div class="promo-calendar__top">
      <div class="col col-xl-4 col-md-6 col-sm-12 promo-calendar__btn">
        <a href="#" class="btn-buy promo-calendar__abonement-btn">{{ __('home.buy_subscription') }}</a>
      </div>
    </div>
    @foreach(session('banners') as $banner)
      @if($banner->is_calendar === 1)
        <h2 class="promo-calendar__title">{{ $banner->translate->title }}</h2>
      @endif
    @endforeach
  </div>
  <figure class="promo-calendar__img">
    @foreach(session('banners') as $banner)
      @if($banner->is_calendar === 1)
        <img src="{{ $banner->getFirstMediaUrl('posters') }}" alt="{{ $banner->translate->title }}">
      @endif
    @endforeach
  </figure>
</section>
