<section class="filter filter--premier" data-filter>
  <h3 class="visually-hidden">{{ __('event.filter') }}</h3>
  <ul class="filter__list row">
    <li class="filter__item col-xl-3 col-12 col-sm-6" data-filter-item="date">
      <button class="filter__name" type="button" data-filter-name>
        <span>{{ ($currentCategory) ? $currentCategory->translate->title : __('event.genre') }}</span>
        <svg width="15" height="15" fill="#333">
          <use xlink:href="#icon-arrow-bottom" />
        </svg>
      </button>
      <ul class="filter__item-list" data-filter-list>
        <li><a href="?all">{{ __('event.genre') }}</a></li>
        @foreach($categories as $category)
          <li><a href="?category_id={{ $category->id }}">{{ $category->translate->title }}</a></li>
        @endforeach
      </ul>
    </li>
  </ul>
</section>
