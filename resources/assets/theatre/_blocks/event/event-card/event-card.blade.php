<div name="about" class="event-card">
     <div class="event-card__card">
    <div class="col col-xl-4 col-md-6 col-sm-12">
      <figure class="event-card__img">
        <img src="{{ $project->getFirstMediaUrl('') }}" alt="Рекламный проспект события">
      </figure>
      @include('pages.theatre._blocks.social-share.social-share')
    </div>
    <div class="col col-xl-8 col-md-6 col-sm-12">
      <div class="event-card__descr">
          {!! $project->translate->description !!}
      </div>
    </div>
  </div>
</div>
