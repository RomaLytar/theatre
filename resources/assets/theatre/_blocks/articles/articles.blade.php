<section name="articles" class="articles">
  @if(isset($title))
    <h2 class="articles__title">{{ $title }}</h2>
  @endif
  <div class="row articles__row {{ (isset($withoutSlider)) ? 'articles__row--no-slick' : '' }}" {{ (isset($withoutSlider)) ? 'data-without-slider' : '' }} data-slick-slider >
    @if(isset($type) && $type === 'performances')
      @foreach($actor->calendars as $calendar)
        {{--        @foreach($calendar->performance()->groupBy('performance_id')->get() as $performance)--}}
        @foreach($calendar->performance as $performance)
          <div class="col-12 col-md-4" data-slider-item >
            @include('pages.theatre._blocks.articles.article.article', ['item' => $performance])
          </div>
        @endforeach
      @endforeach
    @endif
    @if(isset($type) && $type === 'articles')
      @foreach($articles as $article)
        <div class="col-12 col-md-4" data-slider-item>
          @include('pages.theatre._blocks.articles.article.article', ['item' => $article])
        </div>
      @endforeach
    @endif
    @if(isset($type) && $type === 'join_the_league')
        @foreach($articles as $article)
            <div class="col-12 col-md-4" data-slider-item>
                @include('pages.theatre._blocks.articles.article.join_the_league', ['item' => $article])
            </div>
        @endforeach
    @endif
    @if(isset($type) && $type === 'events')
      @foreach($events as $event)
        <div class="col-12 col-md-4" data-slider-item>
          @include('pages.theatre._blocks.articles.article.article', ['item' => $event])
        </div>
      @endforeach
    @endif
    @if(isset($type) && $type === 'eventSchedule')
      @foreach($events as $event)
        @foreach($event->dates as $date)
          @if($date->date > date('Y-m-d H:i:s'))
            <div class="col-12 col-md-4" data-slider-item>
              @include('pages.theatre._blocks.articles.article.article', ['item' => $date->performance, 'date' => $date->date])
            </div>
          @endif
        @endforeach
      @endforeach
    @endif
  </div>
  @if(isset($more) && $more)
    <a href="{{ route($routeMore) }}" class="btn-more btn-more--gold btn-more--mob-initial">{{ __('home.all_articles') }}</a>
  @endif
</section>
