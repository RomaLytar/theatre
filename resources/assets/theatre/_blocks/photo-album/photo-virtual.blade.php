<section class="photo-album" data-gallery>
<div class="row photo-album__row">
    @foreach($images as $image)
        <div class="col-sm-6 col-md-4 col-xl-3 photo-album__img">
            <a href="{{ $image->getUrl('') }}" class="photo-album__link" data-fancybox="gallery">
                <img src="{{ $image->getUrl('preview') }}">
            </a>
        </div>
    @endforeach
    </div>
</section>
