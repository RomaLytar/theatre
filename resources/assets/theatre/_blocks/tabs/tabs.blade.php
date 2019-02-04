@set($activeItem, $activeItem ?? null)
<section class="tabs">
  <div class="tabs__wrap">
    @foreach($items as $item)
      <a href="{{ route('front.team.' . $item->name) }}" class="tabs__link {{ (Route::currentRouteName() === 'front.team.' . $item->name || $item->name === $activeItem) ? 'active' : '' }}">{{ $item->translate->title }}</a>
    @endforeach
  </div>
</section>

