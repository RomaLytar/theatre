<section class="articles articles--maecenas">
  <h2 class="articles__title">{{ $title }}</h2>
  <div class="row" data-slick-slider>
      @foreach($project as $item)
        <div class="col col-sm-6 col-xl-4" data-slider-item>
          @include('pages.theatre._blocks.articles.article.article-maecenas')
        </div>
      @endforeach
  </div>
</section>
