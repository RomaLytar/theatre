<section class="filter filter--mobile" data-filter data-filter-calendar data-popup="filter-calendar">
  <div class="filter__inner">
    <button class="filter__close-btn" data-popup-close>close
      <svg width="20" height="20" fill="#333333">
        <use xlink:href="#icon-cross" />
      </svg>
    </button>
    <h2 class="filter__title">{{ __('calendar.filters') }}</h2>
    <button class="filter__reset-btn" data-reset-all-filters>Сбросить все</button>
    <ul class="filter__list row">
      <li class="filter__item col-md-6 col-lg-3" data-filter-item="event">
        <button class="filter__name" type="button" data-filter-name>
          <span>{{ __('calendar.event') }}</span>
          <svg width="15" height="15" fill="#333">
            <use xlink:href="#icon-arrow-bottom" />
          </svg>
        </button>

        <ul class="filter__item-list" data-filter-list>
          <li><a href="all">{{ __('calendar.event') }}</a></li>
          @foreach ($performancesType as $item)
            <li><a href="event={{ $item->name }}">{{ $item->translate->title }}</a></li>
          @endforeach
        </ul>
      </li>
      <li class="filter__item col-md-6 col-lg-3" data-filter-item="daterange" style="display: none;">
        <button class="filter__name" type="button" data-filter-name>
          <span class="filter__name-date">{{ __('calendar.date') }}</span>
          <svg width="15" height="15" fill="#333">
            <use xlink:href="#icon-arrow-bottom" />
          </svg>
        </button>
        <div class="filter__item-list filter__item-list--daterange" data-filter-list>
          <div data-datepicker></div>
          <a href="#" class="btn-more" data-datepicker-apply>{{ __('calendar.select') }}</a>
        </div>
      </li>
      <li class="filter__item col-md-6 col-lg-3" data-filter-item="date">
        <button class="filter__name" type="button" data-filter-name>
          <span>{{ Date::parse(Date::now())->format('F Y') }}</span>
          <svg width="15" height="15" fill="#333">
            <use xlink:href="#icon-arrow-bottom" />
          </svg>
        </button>
        <ul class="filter__item-list" data-filter-list>
          @foreach($dates as $month => $year)
            <li><a href="year={{ $year }}&month={{ $month - 1 }}">{{ Date::parse(Date::createFromDate($year, $month, 1))->format('F Y') }}</a></li>
          @endforeach
        </ul>
      </li>
      <li class="filter__item col-md-6 col-lg-3" data-filter-item="time">
        <button class="filter__name" type="button" data-filter-name>
          <span>{{ __('calendar.time') }}</span>
          <svg width="15" height="15" fill="#333">
            <use xlink:href="#icon-arrow-bottom" />
          </svg>
        </button>
        <ul class="filter__item-list" data-filter-list>
          <li><a href="all">{{ __('calendar.time') }}</a></li>
          <li><a href="time=daytime">{{ __('calendar.morning') }}</a></li>
          <li><a href="time=night">{{ __('calendar.evening') }}</a></li>
        </ul>
      </li>
      <li class="filter__item col-md-6 col-lg-3" data-filter-item="scene">
        <button class="filter__name" type="button" data-filter-name>
          <span>{{ __('calendar.scene') }}</span>
          <svg width="15" height="15" fill="#333">
            <use xlink:href="#icon-arrow-bottom" />
          </svg>
        </button>
        <ul class="filter__item-list" data-filter-list>
          <li><a href="all">{{ __('calendar.scene') }}</a></li>
          @foreach($performancesHall as $item)
            <li><a href="scene={{ $item->name }}">{{ $item->translate->title }}</a></li>
          @endforeach
        </ul>
      </li>
    </ul>
    <button class="btn-more btn-more--gold btn-more--long filter-btn-apply" data-popup-close>{{ __('home.apply') }}</button>
  </div>
</section>
