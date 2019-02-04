@if(!isset($date))
  @if(isset($calendar->date->date))
    @set($date, $calendar->date->date)
  @else
    @set($date, $item->created_at)
  @endif
@endif

<article class="article">
  <figure class="article__img">
    <a href="{{ route($route, ['id' => $item->id, 'slug' => $item->translate->slug]) }}">
      <img src="{{$item->poster ? $item->poster : $item->getFirstMediaUrl('posters', 'preview') }}"
           alt="{{ $item->translate->title }}"
           data-mobile-url="{{ $item->getFirstMediaUrl('posters', 'preview-mob') }}">
    </a>
  </figure>
  @if($item->translate->city !== '' && isset($isTour))
    <p class="article__city">{{ $item->translate->city }}</p>
  @endif
  @if($item->translate->place !== '' && isset($isTour))
    <p class="article__hall">{{ $item->translate->place }}</p>
  @endif
  @if($item->hall_id)
    <p class="article__type-place">
      <span>{{ $item->type->translate->title }}</span>
      <span>{{ $item->hall->translate->title }}</span>
    </p>
  @endif
  <h3 class="article__title">
    <a href="{{ route($route, ['id' => $item->id, 'slug' => $item->translate->slug]) }}">{{$item->translate->title}}</a>
  </h3>
  @if(!isset($noDate))
    <time class="article__datetime" datetime="{{ \Carbon\Carbon::parse($date)->format('Y-m-d H:i') }}">
      <span class="article__date">{{ Date::parse($date)->format('d F') }}</span>
      <span class="article__time">{{ Date::parse($date)->format('H:i') }}</span>
    </time>
  @endif
  <div class="article__descr">
    <p>{!! str_limit($item->translate->descriptions, 150, '...') !!}</p>
  </div>
  <a href="{{ route($route, ['id' => $item->id, 'slug' => $item->translate->slug]) }}" class="btn-more-link">{{ __('article.more') }}</a>

</article>
