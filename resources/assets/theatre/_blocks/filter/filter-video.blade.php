<section class="filter filter--mobile" data-filter data-popup="filter-videos">
  <div class="filter__inner">
    <button class="filter__close-btn" data-popup-close>close
      <svg width="20" height="20" fill="#333333">
        <use xlink:href="#icon-cross" />
      </svg>
    </button>
    <h2 class="filter__title">{{ __('media.filter') }}</h2>
    <button class="filter__reset-btn">Сбросить все</button>
    <ul class="filter__list filter__list--center row">
      <li class="filter__item col-md-6 col-xl-3" data-filter-item="event">
        <button class="filter__name" type="button" data-filter-name>
          <span>{{ ($currentCategory) ? $currentCategory->translate->title : __('media.all') }}</span>
          <svg width="15" height="15" fill="#333">
            <use xlink:href="#icon-arrow-bottom" />
          </svg>
        </button>
        <ul class="filter__item-list" data-filter-list>
          <li><a href="?{{ ($currentSeason) ? 'season_id=' . $currentSeason->id : '' }}">{{ __('media.all') }}</a></li>
          @foreach($categories as $category)
            <li><a href="?category_id={{ $category->id }}{{ ($currentSeason) ? '&season_id=' . $currentSeason->id : '' }}">{{ $category->translate->title }}</a></li>
          @endforeach
        </ul>
      </li>
      <li class="filter__item col-md-6 col-xl-3" data-filter-item="season">
        <button class="filter__name" type="button" data-filter-name>
          <span>{{ ($currentSeason) ? $currentSeason->translate->title : __('media.allSeasons') }}</span>
          <svg width="15" height="15" fill="#333">
            <use xlink:href="#icon-arrow-bottom" />
          </svg>
        </button>
        <ul class="filter__item-list" data-filter-list>
          <li><a href="?{{ ($currentCategory) ? 'category_id=' . $currentCategory->id : '' }}">{{ __('media.allSeasons') }}</a></li>
          @foreach($seasons as $season)
            <li><a href="?season_id={{ $season->id }}{{ ($currentCategory) ? '&category_id=' . $currentCategory->id : '' }}">{{ $season->translate->title }}</a></li>
          @endforeach
        </ul>
      </li>
      <li class="filter__item col-md-6 col-xl-3" data-filter-item="name">
        <button class="filter__name" type="button" data-filter-name>
          <span>{{ ($currentPerformance) ? $currentPerformance->translate->title : __('home.all_events') }}</span>
          <svg width="15" height="15" fill="#333">
            <use xlink:href="#icon-arrow-bottom" />
          </svg>
        </button>
        <ul class="filter__item-list" data-filter-list>
          <li><a href="?">{{ __('home.all_events') }}</a></li>
          @foreach($performances as $performance)
            <li><a href="?performance_id={{ $performance -> id }}">{{ $performance->translate->title }}</a></li>
          @endforeach
        </ul>
      </li>
      <li class="filter__item col-md-6 col-xl-3" data-filter-item="artist">
        <button class="filter__name" type="button" data-filter-name>
          <span>{{ ($currentActor) ? $currentActor->translate->fullName : __('home.executor') }}</span>
          <svg width="15" height="15" fill="#333">
            <use xlink:href="#icon-arrow-bottom" />
          </svg>
        </button>
        <ul class="filter__item-list" data-filter-list>
          <li><a href="?">{{ __('home.executor') }}</a></li>
          @foreach($actors as $actor)
            <li><a href="?actor_id={{ $actor -> id }}">{{ $actor->translate->fullName }}</a></li>
          @endforeach
        </ul>
      </li>
    </ul>
    <button class="btn-more btn-more--gold btn-more--long filter-btn-apply" data-popup-close>{{ __('home.apply') }}</button>
  </div>
</section>
