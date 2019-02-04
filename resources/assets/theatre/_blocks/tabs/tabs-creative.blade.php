<section class="tabs">
  <div class="tabs__wrap tabs__wrap--fs">
    @foreach($projects as $project)
        <a href="{{ route('front.creative.show', ['id' => $project->id, 'slug' => $project->translate->slug]) }}" class="tabs__link {!! ($route = Route::current()->parameters['id'] == $project->id ) ? 'active' : '' !!}">{{ $project->translate->title }}</a>
    @endforeach
  </div>
</section>
