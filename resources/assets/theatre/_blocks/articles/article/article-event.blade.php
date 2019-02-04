<article class="article">
  <figure class="article__img">
    <a href="{{ route('front.events.show', ['id' => $item->id, 'slug' => $item->translate->slug]) }}">
      <img src="{{ $item->getFirstMediaUrl('posters', 'preview') }}"
           alt="{{ $item->translate->title }}"
           data-mobile-url="{{ $item->getFirstMediaUrl('posters', 'preview-mob') }}">
    </a>
  </figure>
  <div class="article__container">
    <p class="article__type-place">
      <span class="article__type">{{ $item->type->translate->title }}</span>
      <span class="article__place">{{ $item->hall->translate->title }}</span>
    </p>
    <h3 class="article__title">
      <a href="{{ route('front.events.show', ['id' => $item->id, 'slug' => $item->translate->slug]) }}">{{ $item->translate->title }}</a>
    </h3>
    @if(isset($date))
      <time class="article__datetime" datetime="{{ (new DateTime($date))->format('Y-m-d H:i') }}">
        <span class="article__date">{{ Date::parse($date)->format('d F') }}</span>
        <span class="article__time">{{ Date::parse($date)->format('H:i') }}</span>
      </time>
    @endif
    <a href="{{ route('front.events.show', ['id' => $item->id, 'slug' => $item->translate->slug]) }}" class="btn-buy">{{ __('home.buy_ticket') }}</a>
  </div>
</article>

