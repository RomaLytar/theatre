<section class="description-links">
  <h2 class="description-links__title">{{ __('pages.vacancies') }}</h2>
  <div class="description-links__wraper">
    @foreach($vacancy as $item)
    <a href="{{ route('front.vacancies.show', ['id' => $item->id, 'slug' => $item->translate->slug ]) }}" class="description-links__link">{{ $item->translate->title }}</a>
    @endforeach
  </div>
</section>


