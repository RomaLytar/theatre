<section class="tabs">
  <div class="tabs__wrap">
    @foreach($categories as $category)
      <a href="{{ route('front.docs.index', ['id' => $category->id, 'slug' => $category->translate->slug ]) }}" class="tabs__link {!! ($route = Route::current()->parameters['id'] == $category->id ) ? 'active' : '' !!}">{{ $category->translate->title }}</a>
    @endforeach
  </div>
</section>
