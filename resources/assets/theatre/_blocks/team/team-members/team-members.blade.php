@if(isset($actors))
  <section class="team-members">
    @if($has_title)
      <h3 class="team-members__title">{{ $title }}</h3>
    @endif
    <div class="row">
      @foreach($actors as $actor)
        <div class="col-6 col-sm-6 col-md-6 col-xl-4 team-members__item">
          <article class="team-members__article">
            <figure class="team-members__img">
              <img src="{{ $actor->getFirstMediaUrl('posters', 'mini') }}"
                   alt="{{ $actor->fullName() }}"
                   data-mobile-url="{{ $actor->getFirstMediaUrl('posters', 'mini_mob') }}">
            </figure>
            <div class="team-members__descr">
              <p class="team-members__name">{{ $actor->FLname() }}</p>
              <p class="team-members__post">{{ $actor->translate->position }}</p>
              <p class="team-members__regalia">
                <span>{{ $actor->translate->merit }}</span>
              </p>
              <a href="{{ route('front.actors.show', ['id' => $actor->id, 'slug' => $actor->translate->slug]) }}" class="btn-more-link">{{ __('home.more') }}</a>
            </div>
          </article>
        </div>
      @endforeach
    </div>
  </section>
@endif
