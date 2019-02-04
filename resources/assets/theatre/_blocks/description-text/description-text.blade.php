<section class="description-text {{ $class ?? '' }}" data-texttoggle-container data-text>
  <div class="description-text__wrap" data-texttoggle-toggled>
    {!! $description ?: '' !!}
    @include('pages.theatre._blocks.btn-toggle.btn-toggle')
  </div>
</section>
