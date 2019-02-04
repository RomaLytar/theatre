@foreach($items as $item)
  <li class="{{ $i === 0 ? 'menu__item' : '' }} {{ $item->hasChildren() ? 'menu__item--child' : ''}}" {{ $i === 0 ? 'data-menu-item' : '' }}>
    <a href="{!! $item->url() !!}" class="menu__item-name" {{ $i === 0 ? '' : 'tabindex = -1' }}>{!! $item->title !!}</a>
    @if($item->hasChildren())
      <div class="menu__second-wrap" data-menu-second>
        <div class="menu__second-img">
          <p class="menu__second-item-name" data-menu-img>{!! $item->title !!}</p>
          <img src="/design/img/menu/bg.jpg" alt="">
        </div>
        <ul class="menu__second">
          @include('pages.theatre._blocks.menu.menu-items', ['items' => $item->children(), 'i' => 1])
        </ul>
      </div>
    @endif
  </li>
@endforeach



