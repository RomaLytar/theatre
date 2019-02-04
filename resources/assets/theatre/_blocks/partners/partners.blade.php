<section class="partners">
  <div class="row">
    @foreach($partners as $partner)
      <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 d-flex align-items-stretch">
        @include('pages.theatre._blocks.partners.partners-item.partners-item', ['item' => $partner])
      </div>
    @endforeach
  </div>
</section>

