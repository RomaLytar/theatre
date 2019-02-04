<nav class="visit-navigation visit-navigation--big">
  <ul class="visit-navigation__list">
    @foreach($halls as $hall)
    <li>
      <a href="{{ route('front.hall.show', ['id' => $hall->id]) }}">{{ $hall->translate->title }}</a>
    </li>
    @endforeach
  </ul>
</nav>
