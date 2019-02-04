<section class="filter" data-filter>
  <h3 class="visually-hidden">{{ __('calendar.filter') }}</h3>
  <ul class="filter__list row">
    <li class="filter__item col-sm-6 col-xl-3" data-filter-item="event">
      <button class="filter__name" type="button" data-filter-name>
        <span>{{ __('calendar.genre') }}</span>
        <svg width="15" height="15" fill="#333">
          <use xlink:href="#icon-arrow-bottom" />
        </svg>
      </button>
      <ul class="filter__item-list" data-filter-list>
        <li><a href="{{ route('front.calendar.index') }}">{{ __('home.event') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['event' => 'opera']) }}">{{ __('calendar.opera') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['event' => 'ballet']) }}">{{ __('calendar.ballet') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['event' => 'concert']) }}">{{ __('calendar.concert') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['event' => 'children']) }}">{{ __('calendar.children_play') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['event' => 'tour']) }}">{{ __('calendar.touring_on_stage') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['event' => 'festival']) }}">{{ __('calendar.festival_event') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['event' => 'muzhab']) }}">{{ __('calendar.youth_musical_hub') }}</a></li>
      </ul>
    </li>
    <li class="filter__item col-sm-6 col-xl-3" data-filter-item="daterange">
      <button class="filter__name" type="button" data-filter-name>
        <span>{{ __('calendar.date') }}</span>
        <svg width="15" height="15" fill="#333">
          <use xlink:href="#icon-arrow-bottom" />
        </svg>
      </button>
      <div class="filter__item-list filter__item-list--daterange" data-filter-list>
        <div data-datepicker></div>
        <a href="#" class="btn-more" data-datepicker-apply>{{ __('calendar.select') }}</a>
      </div>
    </li>
    <li class="filter__item col-sm-6 col-xl-3" data-filter-item="time">
      <button class="filter__name" type="button" data-filter-name>
        <span>{{ __('calendar.time') }}</span>
        <svg width="15" height="15" fill="#333">
          <use xlink:href="#icon-arrow-bottom" />
        </svg>
      </button>
      <ul class="filter__item-list" data-filter-list>
        <li><a href="{{ route('front.calendar.index') }}">{{ __('calendar.time') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['time' => 'daytime']) }}">{{ __('calendar.morning') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['time' => 'night']) }}">{{ __('calendar.evening') }}</a></li>
      </ul>
    </li>
    <li class="filter__item col-sm-6 col-xl-3" data-filter-item="scene">
      <button class="filter__name" type="button" data-filter-name>
        <span>{{ __('calendar.scene') }}</span>
        <svg width="15" height="15" fill="#333">
          <use xlink:href="#icon-arrow-bottom" />
        </svg>
      </button>
      <ul class="filter__item-list" data-filter-list>
        <li><a href="{{ route('front.calendar.index') }}">{{ __('calendar.scene') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['scene' => 'big']) }}">{{ __('calendar.big_scene') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['scene' => 'small']) }}">{{ __('calendar.small_scene') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['scene' => 'open']) }}">{{ __('calendar.open_scene') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['scene' => 'chamber']) }}">{{ __('calendar.chamber_scene') }}</a></li>
        <li><a href="{{ route('front.calendar.index', ['scene' => 'loft']) }}">{{ __('calendar.loft_scene') }}</a></li>
      </ul>
    </li>
  </ul>
</section>
