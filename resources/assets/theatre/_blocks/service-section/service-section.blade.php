<section class="service-section">
  <ul class="service-section__list">
    @foreach($services as $service)
    <li>
      <h3 class="service-section__title">{{ $service->translate->title }}</h3>
      <div class="service-section__descr">
        <p>{!! $service->translate->description !!}</p>
      </div>
      <a href="#" class="btn-more-link">{{ __('home.more') }}</a>
    </li>
    @endforeach
    {{--</li>--}}
    {{--<li>--}}
      {{--<h3 class="service-section__title">Ваше мероприятие в залах Схид Опера</h3>--}}
      {{--<div class="service-section__descr">--}}
        {{--<p>Soprano Sonya Yoncheva is having a very busy Met season, starting on New Year’s Eve, when she sings the title role of Puccini’s Tosca for the first time. In February, she returns as Mimì in Puccini’s La Bohème, and she takes on a third leading lady in March with the title role of Verdi’s Luisa Miller. With rehearsals for Tosca underway, she spoke with the Met’s Jay Goodwin about embodying what she describes as Puccini’s “completely passionate” title diva.</p>--}}
      {{--</div>--}}
      {{--<ul class="service-section__second-list">--}}
        {{--<li>--}}
          {{--<span>Большой зал</span>--}}
          {{--<a href="#">Скачать описание</a>--}}
        {{--</li>--}}
        {{--<li>--}}
          {{--<span>Малый зал</span>--}}
          {{--<a href="#">Скачать описание</a>--}}
        {{--</li>--}}
        {{--<li>--}}
          {{--<span>Камерная сцена</span>--}}
          {{--<a href="#">Скачать описание</a>--}}
        {{--</li>--}}
        {{--<li>--}}
          {{--<span>Prosto neba stage</span>--}}
          {{--<a href="#">Скачать описание</a>--}}
        {{--</li>--}}
        {{--<li>--}}
          {{--<span>LOFT сцена</span>--}}
          {{--<a href="#">Скачать описание</a>--}}
        {{--</li>--}}
        {{--<li>--}}
          {{--<span>Салон Маэстро</span>--}}
          {{--<a href="#">Скачать описание</a>--}}
        {{--</li>--}}
      {{--</ul>--}}
      {{--<a href="#" class="btn-more-link">Подробнее</a>--}}
  </ul>
</section>
