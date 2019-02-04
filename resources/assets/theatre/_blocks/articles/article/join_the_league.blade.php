
<article class="article">
    <figure class="article__img">
        <a href="{{ route($route, ['id' => $item->id, 'slug' => $item->translate->slug]) }}">
            <img src="{{$item->poster ? $item->poster : $item->getFirstMediaUrl('posters', 'preview') }}"
                 alt="{{ $item->translate->title }}"
                 data-mobile-url="{{ $item->getFirstMediaUrl('posters', 'preview-mobile') }}">
        </a>
    </figure>
    <h3 class="article__title">
        <a href="{{ route($route, ['id' => $item->id, 'slug' => $item->translate->slug]) }}">{{$item->translate->title}}</a>
    </h3>
    <div class="article__descr">
        <p>{!! str_limit($item->translate->description, 150, '...') !!}</p>
    </div>
    <a href="{{ route($route, ['id' => $item->id, 'slug' => $item->translate->slug]) }}" class="btn-more-link">{{ __('article.more') }}</a>
</article>
