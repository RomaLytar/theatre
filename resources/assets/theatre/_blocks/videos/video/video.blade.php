<article class="video" data-video>
  <a href="{{ $video->url }}" class="video__link" data-fancybox>
    <div class="video__img">
      <img src="{{ ($video->getFirstMediaUrl('posters', 'preview')) != null ? $video->getFirstMediaUrl('posters', 'preview') : '//img.youtube.com/vi/' . $video->getImageUrlFromYoutube() . '/0.jpg' }}"
           alt="{{ $video->translate->title }}">
      <p class="video__icon-play">
        <svg width="45" height="45" fill="#fff">
          <use xlink:href="#icon-play" />
        </svg>
      </p>
    </div>
    <div class="video__container">
      <h3 class="video__title">{{ $video->translate->title }}</h3>
      <p class="video__type">{{ $video->category->translate->title }}</p>
    </div>
  </a>
</article>
