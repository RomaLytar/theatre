@foreach($page->blocks as $item)
    <section class="description-text-title">
        <h2 class="description-text-title__title">{{ $item->translate->title }}</h2>
        <div class="description-text-title__wraper">
            {!! $item->translate->descriptions !!}
        </div>
    </section>
    @if($item->getFirstMediaUrl('posters'))
        <section class="visit-img">
            <img src="{{ $item->getFirstMediaUrl('posters') }}" alt="{{ $item->translate->title }}">
        </section>

    @endif
@endforeach
