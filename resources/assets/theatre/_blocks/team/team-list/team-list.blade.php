
@if(count($actors) > 0)
  <section class="team-list" {{ (isset($title_has_toggle)) ? 'data-toggle-item' : '' }}>
    @if(isset($title))
      <h3 class="team-list__title" {{ (isset($title_has_toggle)) ? 'data-toggle-btn' : '' }}> {{ $title }}
        @if(isset($title_has_toggle))
          @include('pages.theatre._blocks.btn-toggle.btn-toggle')
        @endif
      </h3>
    @endif
    <ul class="team-list__list" {{ (isset($title_has_toggle)) ? 'data-toggle-list' : '' }}>
      @foreach($actors as $actor)
        <li class="team-list__item">{{ $actor->fullName() }}</li>
      @endforeach
    </ul>
  </section>
@endif
