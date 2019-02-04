@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    @include('pages.theatre._blocks.artist.artist')

      @if(count($actor->calendars))
        @include('pages.theatre._blocks.articles.articles', [
          'title' => __('actor.in_this_season'),
          'type' => 'performances',
          'route' => $performanceRoute
        ])
      @endif
      @include('pages.theatre._blocks.media.media', [
        'album' => $actor->albums()->latest()->first(),
        'videos' => $actor->videos,
        'title' => $actor->fullname()
      ])
      @if(count($actor->articles))
        @include('pages.theatre._blocks.articles.articles', [
          'type' => 'articles',
          'articles' => $actor->articles,
          'route' => $articleRoute,
          'title' => __('actor.articles_and_press_releases'),
        ])
      @endif
      @include('pages.theatre._blocks.contact-us.contact-us', [
        'title' => __('contact.do_you_want_to_invite_an_artist_contact_us'),
        'titleMobile' => __('contact.do_you_want_to_invite_an_artist_contact_us'),
        'buttonTitle' => __('contact.contacts')
      ])

  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
  @include('pages.theatre._blocks.popup.popup')
@endsection
