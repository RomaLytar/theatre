<article class="article-horizontal">
  <figure class="article-horizontal__img">
    <img src="{{ $performance->getFirstMediaUrl('posters', 'recommended') }}"
         alt="{{ $performance->translate->title }}"
         data-mobile-url="{{ $performance->getFirstMediaUrl('posters', 'preview-mob') }}">
  </figure>
  <div class="article-horizontal__info">
    <h3 class="article-horizontal__title">{{ $performance->translate->title }}</h3>
    <time class="article-horizontal__datetime" datetime="{{ \Carbon\Carbon::parse($date)->format('Y-m-d'.'\T'.'h:i:s') }}">
      <span class="article-horizontal__date">{{ Date::parse($date)->format('d F') }}</span>
      <span class="article-horizontal__time">{{ Date::parse($date)->format('H:i') }}</span>
    </time>
    <div class="article-horizontale__descr">
      {!! str_limit($performance->translate->descriptions, 250) !!}
    </div>
    <a href="{{ route('front.events.show', ['id' => $performance->id, 'slug' => $performance->translate->slug]) }}" class="btn-more-link">{{ __('home.more') }}</a>
  </div>
</article>
