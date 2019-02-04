
<article class="article-tour">
  <figure class="article-tour__img">
    <a href="{{ url('/calendar#/calendar?event=tour&year=' .date("Y"). '&month=' .date('m'). ' ') }}">
      <img src="{{$item->poster ? $item->poster : $item->getFirstMediaUrl('posters', 'preview') }}"
           alt="{{ $item->translate->title }}"
           data-mobile-url="{{ $item->getFirstMediaUrl('posters', 'preview-mob') }}">
    </a>
  </figure>
    <p class="article-tour__city">{{ $item->translate->city }}</p>
    <p class="article-tour__place">{{ $item->translate->place }}</p>
    <p class="article-tour__type-place">
      <span >{{ $item->type->translate->title }}</span>
    </p>
  <h3 class="article-tour__title">
    <a href="{{ url('/calendar#/calendar?event=tour&year=' .date('Y'). '&month=' .date('m'). '') }}">{{$item->translate->title}}</a>
  </h3>
  <p class="article-tour__place">
    <time class="article-tour__datetime" datetime="{{ \Carbon\Carbon::parse($date)->format('Y-m-d H:i') }}">
      <span class="article-tour__date">{{ Date::parse($date)->format('d F h:i') }}</span>
    </time>
  </p>

  <div class="article-tour__descr">
    <p>{!! str_limit($item->translate->descriptions, 150, '...') !!}</p>
  </div>
  <a href="{{ url('/calendar#/calendar?event=tour&year=' .date('Y'). '&month=' .date('m'). ' ') }}" class="btn-more-link">{{ __('article.more') }}</a>

</article>
