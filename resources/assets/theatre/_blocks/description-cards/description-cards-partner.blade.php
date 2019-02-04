<section class="description-cards">
  <h2 class="description-cards__sect-title">{{ $item->category->translate->title }}</h2>
  <div class="description-cards__list">
    <div class="description-cards__item row" data-texttoggle-container>
      <div class="col col-xl-4 col-sm-10 col-md-4 col-12 description-cards__info" data-texttoggle-model>
        <figure class="description-cards__img">
          {!! ($item->url != '') ? '<a href="'. $item->url . '">'  : '' !!}<img src="{{ $item->getFirstMediaUrl('posters') }}" alt="{!! $item->translate->title !!}">{!! ($item->url != '') ? '</a>' : '' !!}
        </figure>
      </div>
      <div class="col col-xl-8 col-sm-10 col-md-8 col-12 description-cards__about" data-texttoggle-parent>
        <div class="description-cards__descr" data-texttoggle-toggled>
          {!! $item->translate->descriptions !!}
          @include('pages.theatre._blocks.btn-toggle.btn-toggle')
        </div>
        <a href="{{ route('front.partners.show', ['id' => $item->id]) }}" class="btn-more-link btn-more-link--fz18" data-more-btn>{{ __('home.more') }}</a>
      </div>
    </div>
  </div>
</section>
