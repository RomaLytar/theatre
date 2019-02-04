<section name="articles" class="articles">
        <h2 class="articles__title">{{ __('pages.events') }}</h2>
    <div class="row articles__row" data-slick-slider >
        @foreach($events as $event)
            <div class="col col-sm-6 col-xl-4" data-slider-item>
                <article class="article">
                    <figure class="article__img">
                        <img src="{{ $event->performance->getFirstMediaUrl('posters', 'preview') }}" alt="">
                    </figure>
                    <p class="article__type-place">
                        <span>{{ __('pages.opera') }}</span>
                        <span>{{ $event->performance->scene }}</span>
                    </p>
                    <h3 class="article__title">
                        <a href="">{{$event->performance->translate->title}}</a>
                    </h3>
                    <time class="article__datetime" datetime="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d H:i') }}">
                        <span class="article__date">{{ \Carbon\Carbon::parse($event->date)->format('d F') }}</span>
                        <span class="article__time">{{ \Carbon\Carbon::parse($event->date)->format('H:i') }}</span>
                    </time>
                    <div class="article__descr">
                        <p>{{ str_limit($event->performance->translate->descriptions, 150) }}</p>
                    </div>
                    <a href="{{ route('front.events.show', ['id' => $event->performance->id, 'slug' => $event->performance->translate->slug]) }}" class="btn-buy btn-buy--big">{{ __('home.buy_ticket') }}</a>
                </article>
            </div>
        @endforeach
    </div>
    <a href="{{ route('front.calendar.index') }}" class="btn-more">{{ $titleButton }}</a>
</section>
