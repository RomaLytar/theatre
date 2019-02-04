<article class="article article--maecenas">
  <figure class="article__img">
    <img src="{{ $item->getFirstMediaUrl('posters', 'preview') }}" alt="{{ $item->translate->title  }}">
  </figure>
  <div class="article__container">
    <h3 class="article__title">
      <a href="#">{{ $item->translate->title  }} </a>
    </h3>
    <div class="article__descr">
     {!! $item->shortDescription(468)  !!}
    </div>
    <a href="{{ route('front.projects.show',['id' => $item->id, 'slug' => $item->translate->slug]) }}" class="btn-more-link btn-more-link--fz12">{{ __('pages.learn_more') }}</a>
  </div>
</article>
