@if(isset($album) || isset($videos))
  <section name="media" class="media {{ $className ?? '' }}"
           data-media data-gallery {{isset($album->id)
           ? 'data-id=' . $album->id .' data-action=' .
           (Route::currentRouteName() == 'front.festivals.show') ? url('api/v1/album-festival') : url('api/v1/album')
           : '' }} {{ $withoutAlbum ?? '' }}>
    <h2 class="media__title">{{ $mainTitle ?? (__('home.photo&video')) }}</h2>
    <div class="row media__list" data-slick-slider-media>
      @set($count, 0)
      @if(isset($album))
        @foreach($album->getMedia('album-images') as $image)
          <div class="col-sm-4">
            @include('pages.theatre._blocks.media.media-item.media-item', [
            'item' => $image->getUrl(),
            'title' => $title,
            'type' => 'photo'
            ])
          </div>
          @set($count, $count+1)
          @if($count >= 6 && !isset($counterOff))
            @break
          @endif
        @endforeach
      @endif
      @if(isset($videos))
        @foreach($videos as $video)
          <div class="col-sm-4">
            @include('pages.theatre._blocks.media.media-item.media-item', [
            'item' => $video,
            'title' => $video->translate->title ?? $title,
            'type' => 'video'
            ])
          </div>
        @endforeach
      @endif

        @if(isset($video_attribute))


        @endif
    </div>
  </section>
@endif


