<section class="tabs">
  <div class="tabs__wrap">
    @foreach($projects as $project)
        <a href="{{ route('front.creative.show', ['id' => $project->id]) }}" class="tabs__link
  {!! (Route::current()->parameters['id']) == $project->id ? 'active' : ''  !!}">{{ $project->translate->title }}</a>
    @endforeach
  </div>
</section>
