<section class="promo-low" data-promo-low>
  @include('pages.theatre._blocks.promo-top.promo-top')
  <figure class="promo-low__img">
    @foreach(session('banners') as $banner)
      @if($banner->is_calendar != 1)
    <img src="{{ $banner->getFirstMediaUrl('posters') }}" alt="{{ $banner->translate->title }}">
      @endif
    @endforeach
  </figure>
</section>
