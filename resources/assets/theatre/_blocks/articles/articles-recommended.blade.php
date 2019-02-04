<section name="articles" class="articles">
    <h2 class="articles__title">{{ __('pages.recommended') }}</h2>
    <div class="row articles__row" data-slick-slider>
        @foreach($recommended as $item)
            <div class="col col-sm-6 col-xl-4" data-slider-item>
                <article class="article">
                    <figure class="article__img">
                        <img src="{{ $item->getFirstMediaUrl('posters', 'preview') }}"
                             alt="{{ $item->translate->title }}"
                             data-mobile-url="{{ $item->getFirstMediaUrl('posters', 'preview-mobile') }}"
                             data-desktop-url="{{ $item->getFirstMediaUrl('posters', 'preview') }}">
                    </figure>
                    <p class="article__type-place">
                        <span>{{ __('pages.opera') }}</span>
                        <span>{{ $item->hall->translate->title }}</span>
                    </p>
                    <h3 class="article__title">
                        <a href="">{{ $item->translate->title }}</a>
                    </h3>
                    <time class="article__datetime" datetime="{{ \Carbon\Carbon::parse($item->date)->format('Y-m-d H:i') }}">
                        <span class="article__date">{{ \Carbon\Carbon::parse($item->date)->format('d F') }}</span>
                        <span class="article__time">{{ \Carbon\Carbon::parse($item->date)->format('H:i') }}</span>
                    </time>
                    <div class="article__descr">
                        <p>{{ str_limit($item->translate->descriptions, 150) }}</p>
                    </div>
                    <a href="{{ route('front.events.show', ['id' => $item->id, 'slug' => $item->translate->slug]) }}" class="btn-more-link">{{ __('pages.learn_more') }}</a>
                </article>
            </div>
        @endforeach
    </div>
</section>
