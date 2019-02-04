<section name="articles" class="articles">
  @if(isset($title))
    <h2 class="articles__title">{{ $title }}</h2>
  @endif
  <div class="row articles__row" data-slick-slider>

    @if(isset($type) && $type === 'articles')
      @foreach($articles as $article)
        <div class="col col-xl-4" data-slider-item>
          @include('pages.theatre._blocks.articles.article.article-abonement', ['item' => $article])
        </div>
      @endforeach
    @endif

  </div>
</section>
