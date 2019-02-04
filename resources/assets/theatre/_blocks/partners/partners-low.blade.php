<section class="partners">
  <h2 class="partners__title">{{ __('pages.opera_partners') }}</h2>
  <div class="row partners__container">

    @foreach($partners as $partner)
      @include('pages.theatre._blocks.partners.partners-item-low.partners-item-low', ['item' => $partner])
    @endforeach
  </div>
</section>

