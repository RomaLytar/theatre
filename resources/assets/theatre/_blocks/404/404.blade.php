<section class="not-found">
  <div class="not-found__inner">
    <h2 class="visually-hidden">404</h2>
    <p class="visually-hidden">{{ __('home.page_not_found') }}</p>
    <figure class="not-found__img">
      <img src="/design/img/404/404.png" alt="">
    </figure>
    <a href="{{ url()->previous() }}" class="not-found__link">{{ __('home.return_back') }}</a>
  </div>
</section>
