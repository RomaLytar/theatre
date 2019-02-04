<section class="description-cards">
  @if($hasTitle)
    <h2 class="description-cards__sect-title">{{ $title }}</h2>
  @endif
  <div class="description-cards__list">
    <div class="description-cards__item row" data-texttoggle-container>
      <div class="col col-12 col-md-4 col-xl-4 description-team__info" data-texttoggle-model>
        <figure class="description-cards__img description-cards__img--margin">
          <img src="{{ $imageUrl ?? '' }}" alt="{!! str_limit($description, 20) !!}">
        </figure>
      </div>
      <div class="col col-12 col-md-8 col-xl-8 description-cards__about" data-texttoggle-parent>
        <div class="description-cards__descr" data-texttoggle-toggled>
          {!! $description !!}
          @include('pages.theatre._blocks.btn-toggle.btn-toggle')
        </div>
      </div>
    </div>
  </div>
</section>
