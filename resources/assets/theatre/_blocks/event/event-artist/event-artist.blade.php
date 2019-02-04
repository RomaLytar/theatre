<article class="event-artist">
  <figure class="event-artist__img">
    <img src="{{ $actorDate->actor->getFirstMediaUrl('posters') }}" alt="{{ $actorDate->actor->fullName() }}">
  </figure>
  <div class="event-artist__descr">
    <p class="event-artist__role">{{ $actorDate->actor->roleName() !== null ? $actorDate->actor->roleName->translate->title : __('actor.no_role') }}</p>
    <p class="event-artist__name">{{ $actorDate->actor->fullName() }}</p>
    <p class="event-artist__regalia">
      <span>{{ $actorDate->actor->translate->degree }}</span>
      <span>{{ $actorDate->actor->translate->merit }}</span>
    </p>
    <p class="event-artist__repertoire">
      <span class="event-artist__participate">{{ __('event.involved') }}</span>
      @foreach($actorDates as $actorDate)
      <span>{{ $actorDate->date->getFormatDate() }}</span>
      @endforeach
    </p>
  </div>
</article>
