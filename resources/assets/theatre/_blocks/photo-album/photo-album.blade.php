<section class="photo-album" data-gallery>
  <h2 class="photo-album__title"><span>{{ $album->category->translate->title }}</span></h2>
  <div class="row">
    @foreach($photos as $image)
      <div class="col-md-6 col-xl-3 photo-album__img">
        <a href="{{ $image->getUrl('') }}" class="photo-album__link" data-fancybox="gallery">
          <img src="{{ $image->getUrl('preview') }}">
        </a>
      </div>
    @endforeach
  </div>
</section>
