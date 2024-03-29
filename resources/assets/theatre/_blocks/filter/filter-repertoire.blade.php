<section class="filter filter--mobile" data-filter data-popup="filter-repertoire">
  <h3 class="visually-hidden">{{ __('event.filter') }}</h3>
  <div class="filter__inner">
    <button class="filter__close-btn" data-popup-close>close
      <svg width="20" height="20" fill="#333333">
        <use xlink:href="#icon-cross" />
      </svg>
    </button>
    <h2 class="filter__title">{{ __('media.filter') }}</h2>
    <ul class="filter__list filter__list--center row">
      <li class="filter__item col-xl-3" data-filter-item="name">
        <button class="filter__name" type="button" data-filter-name>
          <span>{{ ($currentCategory) ? $currentCategory->translate->title : __('event.allEvents') }}</span>
          <svg width="15" height="15" fill="#333">
            <use xlink:href="#icon-arrow-bottom" />
          </svg>
        </button>
        <ul class="filter__item-list" data-filter-list>
          <li><a href="?{{ ($currentSeason) ? 'season_id=' . $currentSeason->id : '' }}">{{ __('event.allEvents') }}</a></li>
          @foreach($categories as $category)
            <li><a href="?category_id={{ $category->id }}{{ ($currentSeason) ? '&season_id=' . $currentSeason->id : '' }}">{{ $category->translate->title }}</a></li>
          @endforeach
        </ul>
      </li>

      <li class="filter__item col-xl-3" data-filter-item="season">
        <button class="filter__name" type="button" data-filter-name>
          <span>{{ ($currentSeason) ? $currentSeason->translate->title : __('event.allSeasons') }}</span>
          <svg width="15" height="15" fill="#333">
            <use xlink:href="#icon-arrow-bottom" />
          </svg>
        </button>
        <ul class="filter__item-list" data-filter-list>
          <li><a href="?{{ ($currentCategory) ? 'category_id=' . $currentCategory->id : '' }}">{{ __('event.allSeasons') }}</a></li>
          @foreach($seasons as $season)
            <li><a href="?season_id={{ $season->id }}{{ ($currentCategory) ? '&category_id=' . $currentCategory->id : '' }}">{{ $season->translate->title }}</a></li>
          @endforeach
        </ul>
      </li>
    </ul>
  </div>
</section>
