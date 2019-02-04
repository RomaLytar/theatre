@if(isset($actor))
  <section class="description-cards">
    @if($hasTitle)
      <h2 class="description-cards__sect-title">{{ $title }}</h2>
    @endif
    <div class="description-cards__list">
      <div class="description-cards__item row" data-texttoggle-container>
        <div class="col-sm-12 col-md-4 col-xl-4 description-team__info" data-texttoggle-model>
          <figure class="description-cards__img description-cards__img--margin">
            <img src="{{ $actor->getFirstMediaUrl('posters','preview') }}"
                 alt="{{ $actor->fullname() }}">
          </figure>
        </div>
        <div class="col-sm-12 col-md-8 col-xl-8 description-cards__about" data-texttoggle-parent>
          <h3 class="description-cards__title">{{ $actor->fullname() }}</h3>
          <p class="description-cards__profession">{{ $actor->translate->position }}</p>
          @if($hasMerit)
            <p class="description-cards__rewards">{{ $actor->translate->merit }}</p>
          @endif
          <div class="description-cards__descr" data-texttoggle-toggled>
            {!! $actor->translate->descriptions !!}
            @include('pages.theatre._blocks.btn-toggle.btn-toggle')
          </div>
          <a href="{{ route('front.actors.show', ['id' => $actor->id, 'slug' => $actor->translate->slug]) }}" class="btn-more-link btn-more-link--fz18 {{ (isset($hideLink)) ? 'hide' : '' }}" data-more-btn>{{ __('home.more') }}</a>
        </div>
      </div>
    </div>
  </section>
@endif

