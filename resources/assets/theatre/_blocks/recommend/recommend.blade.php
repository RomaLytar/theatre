<section class="recommend">
  <h2 class="recommend__title">{{ __('home.recommended') }}</h2>
  <div class="row" data-slick-slider-recommend>
    @foreach($performanceDates as $performanceDate)
      <div class="col col-sm-6 d-flex" data-slider-item>
        @include('pages.theatre._blocks.articles.article-horizontal.article-horizontal', ['performance' => $performanceDate->performance, 'date' => $performanceDate->date])
      </div>
    @endforeach
  </div>
</section>
