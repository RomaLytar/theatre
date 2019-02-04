<section class="description-cards">
  @if($hasTitle)
    <h2 class="description-cards__sect-title">{{ $title }}</h2>
  @endif
  <div class="description-cards__list">
    @if(isset($items))
      @foreach($items as $item)
        <div class="description-cards__item row" data-texttoggle-container>
          <div class="col col-12 col-md-4 col-xl-4 description-cards__info" data-texttoggle-model>
            <figure class="description-cards__img">
              <img src="{{ $item->getFirstMediaUrl('posters','preview') ?? '' }}" alt="{{ $item->translate->title }}">
            </figure>
          </div>
          <div class="col col-12 col-md-8 col-xl-8 description-cards__about" data-texttoggle-parent>
            <h3 class="description-cards__title">{{ $item->translate->title }}</h3>
            <div class="description-cards__descr" data-texttoggle-toggled>
              {!! $item->translate->descriptions !!}
              @include('pages.theatre._blocks.btn-toggle.btn-toggle')
            </div>
          </div>
        </div>
      @endforeach
    @endif

    @foreach($page->blocks as $item)
      <div class="description-cards__item row" data-texttoggle-container>
          <div class="col col-12 col-md-4 col-xl-4 description-cards__info" data-texttoggle-model>
            <figure class="description-cards__img">
            <img src="{{ $item->getFirstMediaUrl('posters','preview') ?? '' }}" alt="{{ $item->translate->title }}">
            </figure>
          </div>
          <div class="col col-12 col-md-8 col-xl-8 description-cards__about" data-texttoggle-parent>
          <div class="description-cards__descr" data-texttoggle-toggled>
          {!! $item->translate->descriptions !!}
          @include('pages.theatre._blocks.btn-toggle.btn-toggle')
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>

