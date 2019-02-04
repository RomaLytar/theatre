<section class="description-item {{ (isset($position) && $position === 'right') ? 'description-item--right' : '' }}">
  <figure class="description-item__img">
    <img src="{{ $imageUrl ?? '' }}" alt="{!! str_limit($description, 20) !!}">
  </figure>
  <div class="description-item__descr">
    {!! $description !!}
  </div>
</section>
