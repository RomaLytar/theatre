<section class="description-cards description-cards--small">
  <div class="description-cards__list">
    @foreach($projects as $item)
    <div class="description-cards__item row" data-texttoggle-container>
      <div class="col col-12 col-md-4 col-xl-4 description-cards__info" data-texttoggle-model>
        <figure class="description-cards__img">
          <img src="{{ $item->getFirstMediaUrl('posters', 'preview') }}" alt="{{ $item->translate->title }}">
        </figure>
      </div>
      <div class="col col-12 col-md-8 col-xl-8 description-cards__about" data-texttoggle-parent>
        <h3 class="description-cards__title">{{ $item->translate->title }}</h3>
        <div class="description-cards__descr" data-texttoggle-toggled>
          {!! $item->translate->description !!}
          @include('pages.theatre._blocks.btn-toggle.btn-toggle')
        </div>
        <a href="{{ route('front.contests.contest', ['id' => $item->id, 'slug' => $item->translate->slug]) }}" class="btn-more-link btn-more-link--fz18" data-more-btn>{{ __('article.more') }}</a>
      </div>
    </div>
    @endforeach
  </div>
</section>
