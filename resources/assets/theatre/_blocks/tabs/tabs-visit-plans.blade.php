<section class="tabs">
  <div class="tabs__wrap">
    @foreach($halls as $hall)
      <a href="{{ route('front.hall.show', ['id' => $hall->id, 'slug' => $hall->translate->slug]) }}" class="tabs__link {!! (Route::current()->parameters['id']) == $hall->id ? 'active' : '' !!}">{{ $hall->translate->title }}</a>
    @endforeach
  </div>
</section>
