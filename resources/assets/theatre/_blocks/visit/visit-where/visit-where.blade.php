<section class="visit-where">
  @set($itemsCount, count($items))
  @for($i = 0; $i < $itemsCount; $i++)
    <div class="visit-where__sect">
      <h2 class="visit-where__title">{{ $items[$i]->translate->title }}</h2>
      @if($items[$i]->attribute->name === 'description')
        <div class="visit-where__descr {{ $i === 1 ?: 'visit-where__descr--50'  }}">
          {!! $items[$i]->translate->descriptions !!}
        </div>
      @endif

      @if($items[$i]->attribute->name === 'map_coordinates')
        <div class="visit-where__map" data-map data-map-coordinate="{{ $items[$i]->translate->descriptions }}" data-map-scale="15"></div>
      @endif
    </div>
  @endfor
</section>
