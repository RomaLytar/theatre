<section class="tabs">
  <div class="tabs__wrap">
    <a href="{{ url('/excursion') }}" class="tabs__link {{ (Request::url() == url('/excursion')) ? 'active' : '' }}">{{ __('pages.excursion') }}</a>
    <a href="{{ url('/virtual-tour') }}" class="tabs__link {{ (Request::url() == url('/virtual-tour')) ? 'active' : '' }}">{{ __('pages.virtual_tour') }}</a>
    <a href="{{ url('/tour-video') }}" class="tabs__link {{ (Request::url() == url('/tour-video')) ? 'active' : '' }}">{{ __('pages.promo_video') }}</a>
    <a href="{{ url('/other') }}" class="tabs__link {{ (Request::url() == url('/other')) ? 'active' : '' }}">{{ __('pages.different') }}</a>
  </div>
</section>
