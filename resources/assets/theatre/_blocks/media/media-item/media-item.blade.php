{{-- для видео нужно добавлять атрибут data-video для <article class="media-item"> --}}
<article class="media-item" data-media-item {{ $type == 'video' ? 'data-video' : '' }}>
  <a href="{{ isset($item->url) ? $item->url : $item }}" class="media-item__link">
    <div class="media-item__media">
      <img src="{{ $type == 'video' ? '//img.youtube.com/vi/' . $item->getImageUrlFromYoutube() . '/0.jpg' : (isset($item->url) ? $item->url :$item) }}" alt="{{ $title }}">
    </div>
    <p class="media-item__title">{{ $title }}</p>
    <p class="media-item__icon-play">
      <svg width="45" height="45" fill="#fff">
        <use xlink:href="#icon-play" />
      </svg>
    </p>
  </a>
</article>
