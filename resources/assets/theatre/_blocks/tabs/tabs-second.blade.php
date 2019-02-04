@if(isset($items))
  <section class="tabs tabs--second">
    <div class="tabs__wrap">
      @foreach($items as $item)
        <a href="{{ route('front.team.troupe.' . $item->name) }}" class="tabs__link {{ Route::currentRouteName() === 'front.team.troupe.' . $item->name ? 'active' : '' }}">{{ $item->translate->title }}</a>
      @endforeach
    </div>
  </section>
@endif
