<section class="ebook-item">
  <figure class="ebook-item__img">
    <img src="{{ $ebook->getFirstMediaUrl('posters','preview') }}" alt="{{ $ebook->translate->title }}">
  </figure>
  <div class="ebook-item__container">
    <a href="{{ $ebook->translate->file }}" download class="ebook-item__btn">{{ __('pages.download') }}</a>
    <a href="{{ $ebook->translate->file }}" class="ebook-item__btn ebook-item__btn--red" target="_blank">{{ __('pages.read') }}</a>
  </div>
</section>
