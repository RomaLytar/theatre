<article class="article">
  <figure class="article__img">
    <a href="{{ route('front.events.show', ['id' => $item->id, 'slug' => $item->translate->slug]) }}">
      <img src="{{ $item->getFirstMediaUrl('posters', 'poster') }}" alt="{{ $item->translate->title }}">
    </a>
  </figure>
  <div class="article__container">
    <h3 class="article__title article__title--abonement">
      <a href="{{ route('front.events.show', ['id' => $item->id, 'slug' => $item->translate->slug]) }}">{{ $item->translate->title }}</a>
    </h3>
    <p class="article__price">1000грн.</p>
    <div class="article__descr article__descr--abonement">
     {!! $item->shortDescription(468)  !!}
    </div>

    <a href="{{ route('front.events.show', ['id' => $item->id, 'slug' => $item->translate->slug]) }}" class="btn-buy">{{ __('home.buy_ticket') }}</a>
  </div>
</article>
