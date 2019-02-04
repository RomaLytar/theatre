<section class="col-3 col-sm-3 col-md-3 col-lg-2 col-xl-2 partners-item-low">
  <h2 class="visually-hidden">{{ __('pages.opera_partners') }}</h2>
  <a href="{{($item->url_partner == '') ? route('front.partners.show', ['id' => $item->id]) : $item->url }}" class="partners-item__link" title="{{ $item->translate->title }}">
    <figure class="partners-item-low__img">
      <img src="{{ $item->getFirstMediaUrl('posters') }}" alt="{{ $item->translate->title }}">
    </figure>
  </a>
</section>
