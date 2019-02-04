<section class="description-cards">
  <h2 class="description-cards__sect-title">{!! $hall->translate->title !!}</h2>
  <div class="description-cards__list">
    <div class="description-cards__item row">
      <div class="col-sm-12 col-lg-8 description-cards__about">
        <div class="description-cards__descr">
        {!! $hall->translate->description !!}
        </div>
      </div>
      <div class="col-sm-12 col-lg-4 description-cards__info description-cards__info--bold">
          <p>{{ __('pages.capacity') }} {{ $hall->spaciousness }} {{ __('pages.people') }}</p>
      </div>
    </div>
  </div>
</section>

