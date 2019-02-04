<section class="gallery gallery--event">
    @foreach($page->blocks as $block)
    <h2 class="gallery__title">{{ $block->translate->title }}</h2>
    @endforeach
    <div class="row" data-gallery-event data-gallery>
        @foreach($images as $image)
            <div class="col-sm-6 col-xl-4 gallery__img">
                <a href="{{ $image->getUrl('') }}" class="gallery__link" data-fancybox="gallery">
                    <img src="{{ $image->getUrl('preview') }}">
                </a>
            </div>
        @endforeach
    </div>
</section>
