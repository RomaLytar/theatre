<section class="description-cards description-cards--only-text">
  <div class="description-cards__list">
    <div class="description-cards__item row">
      @foreach($items as $item)
        <div class="col-xl-8 description-cards__about">
          <h3 class="description-cards__title description-cards__title--bold">{!! $item->translate->title !!}</h3>
          <div class="description-cards__descr">
            {!! $item->translate->descriptions !!}
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
