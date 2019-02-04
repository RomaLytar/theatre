<section class="special-projects">
  <h2 class="special-projects__title">{{ __('home.special_projects') }}</h2>
  <div class="row special-projects__slider" data-slick-slider-special-projects>
    @foreach($performanceDates as $performanceDate)
      <div class="col col-sm-6" data-slider-item>
        <article class="special-projects__item">
          <figure class="special-projects__img">
            <img src="{{ $performanceDate->performance->getFirstMediaUrl('posters', 'special') }}"
                 alt="{{ $performanceDate->performance->translate->title }}"
                 data-mobile-url="{{ $performanceDate->performance->getFirstMediaUrl('posters', 'preview-mob') }}">
          </figure>
          <div class="special-projects__info">
            <h3 class="special-projects__name">{{ $performanceDate->performance->translate->title }}</h3>
            <div class="special-projects__descr">
              {!! str_limit($performanceDate->performance->translate->descriptions, 300) !!}
            </div>
            <a href="{{ route('front.events.show', [
                'id' => $performanceDate->performance->id,
                'slug' => $performanceDate->performance->translate->slug
              ]) }}" class="btn-more-link">{{ __('home.more') }}</a>
          </div>
        </article>
      </div>
    @endforeach
  </div>
</section>
