<section name="artists" class="event-artists" data-event-parent>
  <h2 class="event-artists__title">{{ __('event.characters&actors') }}</h2>
  <section class="filter-event">
    @include('pages.theatre._blocks.filter.filter-event')
  </section>
  <div class="row event-artists__list">
    @foreach($groupActorDates as $actorDates)
          @set($show,true)
          @foreach ($actorDates as $actorDate)
              @if($show == true)
                  <div class="col-sm-4 event-artists__item d-flex align-items-stretch" data-date="{{ $actorDate->date->getFormatDate() }}" data-event-artist>
                    @include('pages.theatre._blocks.event.event-artist.event-artist', ['actorDate' => $actorDate, 'actorDates' => $actorDates])
                  </div>
                  @set($show, !$show)
              @endif
          @endforeach
    @endforeach
  </div>
</section>
