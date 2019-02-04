<ul class="calendar-type" data-calendar-type>
  <li class="calendar-type__item calendar-type__item--mob-hide">
    <a href="#/calendar" data-calendar-type-link class="calendar-type__link">{{ __('calendar.calendar') }}</a>
  </li>
  <li class="calendar-type__item">
    <a href="#/events" data-calendar-type-link data-calendar-type-link-list class="calendar-type__link calendar-type__link--gold">{{ __('calendar.events_list') }}</a>
  </li>
  <li class="calendar-type__item">
    <a href="#/search" data-calendar-type-link class="calendar-type__link calendar-type__link--search calendar-type__link--gold">{{ __('calendar.search_by_event') }}
      <svg width="12" height="12" fill="#333">
        <use xlink:href="#icon-search" />
      </svg>
    </a>
  </li>
  <li class="calendar-type__item calendar-type__item--filter">
    <button class="calendar-type__filter-btn" type="button" data-calendar-filter data-popup-link="filter-calendar">
      <span>{{ __('calendar.events_filter') }}</span>
      <svg width="15" height="15" fill="#333">
        <use xlink:href="#icon-arrow-bottom" />
      </svg>
    </button>
  </li>
</ul>

