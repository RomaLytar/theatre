@set($count, -1)

<section class="articles articles--representation">
  <h2 class="articles__title articles__title--big">{{ $title ?? __('home.poster') }}</h2>
@if(!isset($noFilter))
  @include('pages.theatre._blocks.filter.filter-main')
@endif
  @if(isset($performances))
    <div class="row articles__row" data-slick-slider>
      @foreach($performances as $performance)
        <div class="col col-xl-4" data-slider-item>
          @include('pages.theatre._blocks.articles.article.article-event', ['item' => $performance, 'date' => $performance->premierTime()])
        </div>
      @endforeach
    </div>
  @endif
  @if(isset($calendars))
    @set($count, count($calendars))
    <div class="row" data-slick-slider>
      @foreach($calendars as $calendar)
        <div class="col col-xl-4" data-slider-item>
          @include('pages.theatre._blocks.articles.article.article-event', ['item' => $calendar->performance, 'date' => $calendar->date])
        </div>
      @endforeach
    </div>
  @endif
  @if($count === -1 || $count > 2)
    {{--<a href="{{ route('front.calendar.index') }}" class="btn-more">{{ __('home.all_events') }}</a>--}}
  @endif
</section>
