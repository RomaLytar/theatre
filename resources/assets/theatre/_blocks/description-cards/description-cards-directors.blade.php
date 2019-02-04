<section class="description-cards">
  <h2 class="description-cards__sect-title">{{ __('event.directors') }}</h2>
  <div class="description-cards__list">
    <div class="description-cards__item row" data-texttoggle-container>
      <div class="col col-xl-4 col-sm-10 col-md-4 col-12 description-cards__info" data-texttoggle-model>
        <figure class="description-cards__img">
          <img src="{{ $performance->getFirstMediaUrl('directors', 'poster') ?? '' }}" alt="{!! str_limit($performance->translate->directors2, 20) !!}">
        </figure>
      </div>
      <div class="col col-xl-8 col-sm-10 col-md-8 col-12 description-cards__about" data-texttoggle-parent>
        <div class="description-cards__descr"  data-texttoggle-toggled>
          {!! $performance->translate->directors !!}
          @include('pages.theatre._blocks.btn-toggle.btn-toggle')
        </div>
      </div>
    </div>
    @if(isset($performance->translate->directors2))
      <div class="description-cards__item row" data-texttoggle-container>
        <div class="col col-xl-4 col-sm-10 col-md-4 col-12 description-cards__info" data-texttoggle-model>
          <figure class="description-cards__img">
            <img src="{{ $performance->getFirstMediaUrl('directors2', 'poster') ?? '' }}" alt="{!! str_limit($performance->translate->directors2, 20) !!}">
          </figure>
        </div>
        <div class="col col-xl-8 col-sm-10 col-md-8 col-12 description-cards__about" data-texttoggle-parent>
          <div class="description-cards__descr" data-texttoggle-toggled>
            {!! $performance->translate->directors2 !!}
            @include('pages.theatre._blocks.btn-toggle.btn-toggle')
          </div>
        </div>
      </div>
    @endif
  </div>
</section>

