<div data-promo-slider class="promo-slider">
  @foreach($performanceDates as $performanceDate)
    <div class="promo-slider__slide">
      <figure class="promo-slider__img">
        <img src="{{ $performanceDate->performance->getFirstMediaUrl('posters', 'slider') }}"
             alt="{{ $performanceDate->performance->translate->title }}"
             data-promo-mobile-url="{{ $performanceDate->performance->getFirstMediaUrl('posters', 'slider-mobile') }}">
      </figure>
      <div class="promo-slider__about">
        <h3 class="promo-slider__title">{{ $performanceDate->performance->translate->title }}</h3>
        @if (date('Y-m-d H:i:s') > $performanceDate->date)
          {{ '' }}
          @else
          <time datetime="{{ (new DateTime($performanceDate->date))->format('Y-m-d H:i') }}" class="promo-slider__datetime">
            <span class="promo-slider__date">{{ (Date::parse($performanceDate->date))->format('j F') }}</span>
            <span class="promo-slider__time">{{ (Date::parse($performanceDate->date))->format('H:i') }}</span>
          </time>
          @endif
        <div class="promo-slider__descr">
          {!! $performanceDate->shortTagline(100) !!}
        </div>
        <div class="promo-slider__links">
          <a href="{{ route('front.events.show', ['id' => $performanceDate->performance->id, 'slug' => $performanceDate->performance->translate->slug]) }}" class="promo-slider__more">{{ __('home.more') }}</a>
          @if (date('Y-m-d H:i:s') > $performanceDate->date)
            {{ '' }}
          @else
            <a href="{{ ('/ticket/perfomance/'.$performanceDate->id) }}" class="btn-buy btn-buy--big">{{ __('home.buy_ticket') }}</a>
          @endif
        </div>
      </div>
    </div>
  @endforeach
</div>
  <a href="#about" class="promo-slider__arrow" data-scroll-arr>Следующий экран
    <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 404.257 404.257" width="65px" height="65px" fill="#FFFFFF">
      <polygon points="386.257,114.331 202.128,252.427 18,114.331 0,138.331 202.128,289.927 404.257,138.331 "/>
    </svg>
  </a>
