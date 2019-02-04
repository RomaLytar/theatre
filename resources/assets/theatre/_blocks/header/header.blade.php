@include('pages.global._blocks.svg.symbols')

<header class="header" data-header>
  <div class="header__wrap">
    <div class="header__inner">
      <div class="header__mobile-wrapper">
        <p class="header__season">{{ __('home.season') }} №{{ setting(session('locale') . '.' . 'current_season') }}</p>
        <a @if(Route::currentRouteName() !== 'front.home') href="{{ route('front.home') }}" @endif class="header__logo">
          <img src="/design/img/logo/logo.svg" alt="">
        </a>

        <button type="button" class="burger" data-menu-btn>
          Menu
          <span class="burger__toggle-line burger__toggle-line--1"></span>
          <span class="burger__toggle-line burger__toggle-line--2"></span>
          <span class="burger__toggle-line burger__toggle-line--3"></span>
        </button>

        @include('pages.theatre._blocks.calendar-btn.calendar-btn')
      </div>
      <div class="header__drop">

        @include('pages.theatre._blocks.menu.menu')

        <div class="header__link" data-header-link>
          <a href="{{ route('front.user.index') }}" class="header__login" data-header-enter>
            <svg width="10" height="10">
              <use xlink:href="#icon-user" />
            </svg>
            <span>{{ __('home.log_in') }}</span>
          </a>

          <a href="{{ route('front.page.search') }}" class="header__search">
            <svg width="10" height="10">
              <use xlink:href="#icon-search" />
            </svg>
            {{ __('home.search') }}
          </a>
        </div>

        @include('pages.theatre._blocks.lang.lang')
        <div class="header__social" data-header-social>
          @include('pages.theatre._blocks.social.social')
        </div>
      </div>
    </div>
  </div>
</header>
