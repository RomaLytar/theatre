<section class="info">
  <h2 class="info__title">{{ __('pages.guest_stars') }}</h2>
    @foreach($guestStars as $actors_post)
      <div class="info__item">
        <h3>{{ strip_tags($actors_post[0]) }}</h3>
        <p>{{ strip_tags($actors_post[1]) }}</p>
      </div>
    @endforeach
</section>