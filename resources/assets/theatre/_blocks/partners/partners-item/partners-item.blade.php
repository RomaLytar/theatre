<section class="partners-item">
  <a href="{{($item->url_partner == '') ? route('front.partners.show', ['id' => $item->id]) : $item->url }}" class="partnerss-item__link" title="{{ $item->translate->title }}">
    <h2 class="partners-item__title" data-partner-title>{{ $item->category->translate->title }}</h2>
    <div class="partners-item__wrap">
      <figure class="partners-item__img">
       <img src="{{ $item->getFirstMediaUrl('posters') }}" alt="{{ $item->translate->title }}">
      </figure>
    </div>
  </a>
</section>
