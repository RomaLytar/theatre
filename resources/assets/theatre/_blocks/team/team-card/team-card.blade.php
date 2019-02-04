<article class="team-card">
  <figure class="team-card__img">
    <img src="{{$actor->photo}}" alt="{{$actor->translate->firstName}} {{$actor->translate->lastName}}">
  </figure>
  <div class="team-card__descr">
    <p class="team-card__type">{{$actor->group->translate->actor_group}}</p>
    <p class="team-card__name">{{$actor->translate->firstName}} {{$actor->translate->lastName}}</p>
    <p class="team-card__regalia">
      <span>{{$actor->translate->degree}}</span>
    </p>
    <p class="team-card__repertoire">
      <b>В этом сезоне</b>
      @foreach($actor->calendars as $calendar)
{{--        @foreach($calendar->performance()->groupBy('performance_id')->get() as $performance)--}}
        @foreach($calendar->performance as $performance)
          <span>{{$performance->translate->title}}</span>
        @endforeach
      @endforeach
      <a class="team-card__link" href="{{ route('front.actors.show', ['id' => $actor->id, 'slug' => $actor->translate->slug]) }}">Подробнее</a>
    </p>
  </div>
</article>
