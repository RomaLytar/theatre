<footer class="footer">
  <div class="wrap">
    <div class="container-fluid">
      <div class="footer__contacts row">
        <h3 class="visually-hidden">{{ __('footer.contact_information') }}</h3>
        <div class="col-md-4 footer__main-logo-container">
          <figure class="footer__main-logo">
            <img src="/design/img/logo/logo.svg" alt="Logo">
          </figure>
        </div>
        <div class="col-md-4 col-12">
          <div class="footer__contact">
            <h4 class="footer__title footer__title--margin">{{ __('footer.contacts') }}</h4>
            <p class="footer__contact-address">{{ setting(session('locale') . '.' . 'postcode') }}, {{ setting(session('locale') . '.' . 'city') }} {{ setting(session('locale') . '.' . 'address') }}</p>
            <p class="footer__contact-address"><a href="mailto:{{ setting(session('locale') . '.' . 'email') }}" class="footer__contact-mail">{{ __('footer.email') }}:  {{ setting(session('locale') . '.' . 'email') }}</a></p>
          </div>
        </div>
        <div class="col-md-4 col-12">
          <div class="footer__contact">
            <h4 class="footer__title footer__title--margin">{{ __('footer.cashbox') }}</h4>
            <p class="footer__contact-address">{{ __('footer.theatre_cashbox') }} {{ setting(session('locale') . '.' . 'phone_cashbox') }}</p>
            <p class="footer__contact-address">{{ __('footer.tour_cashbox') }} {{ setting(session('locale') . '.' . 'phone_cashbox_tour') }}</p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center footer__link">
        <a class="btn-more-link" href="/contacts">{{ __('footer.all_contacts') }}</a>
      </div>
      <div class="row justify-content-center align-items-center">
        @if(\Cache::get('mainPartners') !== null)
          @foreach(\Cache::get('mainPartners') as $partner)
            <div class="col-md-4 sm-1">
              <h4 class="footer__title footer__title--mobile">{{ $partner->category->translate->title }}</h4>
              <figure class="footer__logo-partner footer__logo-partner--margin">
                {!! ($partner->url != '') ? '<a href="'. $partner->url . '">'  : '' !!}<img src="{{ $partner->getFirstMediaUrl('posters') }}" alt="{{ $partner->translate->title }}"> {!! ($partner->url != '') ? '</a>' : '' !!}
              </figure>
            </div>
          @endforeach
        @endif

      </div>
      <div class="row justify-content-around">
        <h4 class="footer__title footer__title--initial footer__title--mobile col-md-12">{{ __('footer.all_partners') }}</h4>
        @if(\Cache::get('partners') !== null)
          @foreach(\Cache::get('partners') as $partner)
            <div class="col-3 footer__logo-container">
              <figure class="footer__logo-partner">
                {!! ($partner->url != '') ? '<a href="'. $partner->url . '">'  : '' !!}<img src="{{ $partner->getFirstMediaUrl('posters') }}" alt="{{ $partner->translate->title }}">{!! ($partner->url != '') ? '</a>' : '' !!}
              </figure>
              <p class="footer__title-second">{{ $partner->category->translate->title }}</p>
            </div>
          @endforeach
        @endif
      </div>
      <div class="footer__social" data-footer-social>
      </div>
    </div>
  </div>
</footer>

