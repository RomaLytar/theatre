<section class="filter" data-filter>
  <h3 class="visually-hidden">{{ __('event.filter') }}</h3>
  <ul class="filter__list filter__list--center row">
    <li class="filter__item col-xl-3" data-filter-item="date">
      <button class="filter__name" type="button" data-filter-name>
        <span>{{ __('event.allDates') }}</span>
        <svg width="15" height="15" fill="#333">
          <use xlink:href="#icon-arrow-bottom" />
        </svg>
      </button>
      <ul class="filter__item-list" data-filter-list>
        <li><a href="all">{{ __('event.allDates') }}</a></li>
      </ul>
    </li>
  </ul>
</section>
