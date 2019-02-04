<section class="artist">
  <h1 class="visually-hidden">{{$actor->translate->firstName}} {{$actor->translate->lastName}}</h1>

  @include('pages.theatre._blocks.description-cards.description-cards-team', [
  'hasTitle' => false,
  'hasMerit' => true,
  'actor' => $actor,
  'hideLink' => false
  ])

    <div class="artist__info">
      <div class="row">
        <div class="col-sm-12 col-md-6  col-xl-4">
          <h3 class="artist__info-title">{{ __('actor.hometown') }}</h3>
          <ul class="artist__info-list">
            <li>{{$actor->translate->hometown}}</li>
          </ul>
          <h3 class="artist__info-title">{{ __('actor.debut') }}</h3>
          <ul class="artist__info-list">
            <li>{{$actor->translate->debut}}</li>
          </ul>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4">
          <h3 class="artist__info-title">{{ __('actor.merit') }}</h3>
          <ul class="artist__info-list">
            <li>{{$actor->translate->merit}}</li>
          </ul>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4">
          <h3 class="artist__info-title">{{ __('actor.repertoire') }}</h3>
          <ul class="artist__info-list artist__info-list--mob-nm">
            <li>{{$actor->translate->repertoire}}</li>
          </ul>
        </div>
      </div>
    </div>
</section>
