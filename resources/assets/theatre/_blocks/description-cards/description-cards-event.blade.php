<section class="description-cards description-cards--synopsis">
  <article class="description-cards__list">
    <div class="description-cards__item row">
      <div class="col col-12 col-md-4 col-xl-4 description-cards__info">
        <figure class="description-cards__img">
          <img src="/design/img/description-event/description-event.jpg" alt="Фото">
        </figure>
        <div class="description-cards__share">
          @include('pages.theatre._blocks.social-share.social-share')
        </div>
      </div>
      <div class="col col-12 col-md-8 col-xl-8 description-cards__about">
        <div class="description-cards__sect">
          <h4>{{ __('event.composer') }}:</h4>
          <p>{!! $item->translate->author !!}</p>
        </div>
        <div class="description-cards__sect">
          <h4>{{ __('event.directors') }}:</h4>
          <p>{!! $item->translate->directors !!}</p>
        </div>
        <div class="description-cards__sect">
          <h4>{{ __('event.language') }}</h4>
          <p>{{ $item->translate->lang }}</p>
        </div>
      </div>
    </div>
  </article>
</section>
