<article class="album">
  <a class="album__link" href="{{ route('front.albums.show', ['id' => $album->id, 'slug' => $album->translate->slug]) }}">
    <figure class="album__img">
      <img src="{{ $album->getFirstMediaUrl('posters', 'preview') }}" alt="">
    </figure>
    <div class="album__container">
      <h3 class="album__title">{{ $album->translate->title }}</h3>
      <p class="album__type">{{ $album->category->translate->title }}</p>
    </div>
  </a>
</article>
