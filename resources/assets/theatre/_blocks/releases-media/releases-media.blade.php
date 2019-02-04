@if(isset($images) || isset($videos))
<div class="wrap-full">
  <section class="releases-media container-fluid" data-gallery>
    <h2 class="releases-media__title">{{ __('article.photos&videos') }}</h2>
    <div class="releases-media__slider row" data-slick-slider-releases>
      @foreach($images as $image)
        <div class="col col-sm-6 col-xl-4 releases-media__item" data-slider-item>
          <a class="releases-media__link" data-fancybox="gallery" href="{{ $image->getUrl() }}">
            <p class="releases-media__img">
              <img src="{{ $image->getUrl('preview-big') }}" alt="{{ $title }}">
            </p>
            <p class="releases-media__icon-play">
              <svg width="45" height="45" fill="#fff">
                <use xlink:href="#icon-play" />
              </svg>
            </p>
          </a>
        </div>
      @endforeach
      @foreach($videos as $video)
        <div class="col col-sm-6 col-xl-4 releases-media__item" data-slider-item data-video>
          <a class="releases-media__link" data-fancybox="gallery" href="{{ $video->url }}&amp;autoplay=none">
            <p class="releases-media__img">
              <img src="//img.youtube.com/vi/{{ $video->getImageUrlFromYoutube() }}/0.jpg" alt="{{ $title }}">
            </p>
            <p class="releases-media__icon-play">
              <svg width="45" height="45" fill="#fff">
                <use xlink:href="#icon-play" />
              </svg>
            </p>
          </a>
        </div>
      @endforeach
    </div>
  </section>
</div>
@endif
