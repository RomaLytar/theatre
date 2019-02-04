<section class="call-us {{ $class ?? '' }}">
  <h1>Смотрим, возможно, можно заменить на deacription-text-tile</h1>
  <h3 class="call-us__title">{{ $item->translate->title ?? '' }}</h3>
  <div class="call-us__descr">
    {!! $item->translate->descriptions ?? '' !!}
  </div>
</section>
