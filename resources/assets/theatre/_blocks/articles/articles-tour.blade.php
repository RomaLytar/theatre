<section name="articles" class="articles">
  @if(isset($title))
    <h2 class="articles__title">{{ $title }}</h2>
  @endif
  <div class="row articles__row" data-slick-slider>
    @if(isset($type) && $type === 'eventSchedule')
      @foreach($events as $event)
        @foreach($event->dates as $date)
          @if($date->date > date('Y-m-d H:i:s'))
            <div class="col col-xl-4" data-slider-item>
              @include('pages.theatre._blocks.articles.article-tour.article-tour', ['item' => $date->performance, 'date' => $date->date])
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
