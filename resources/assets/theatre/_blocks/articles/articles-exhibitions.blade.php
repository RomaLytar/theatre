<section name="articles" class="articles">
    <h2 class="articles__title">{{ __('pages.exhibitions') }}</h2>
        <div class="row articles__row" data-slick-slider>
            @foreach($articles as $article)
            <div class="col col-sm-6 col-xl-4" data-slider-item>
                <article class="article">
                    <figure class="article__img">
                            <img src="{{$article->poster ? $article->poster : $article->getFirstMediaUrl('posters')}}" alt="">
                    </figure>
                    <h3 class="article__title">
                        <a href="">{{ $article->translate->title }}</a>
                    </h3>
                    <time class="article__datetime" datetime="{{ \Carbon\Carbon::parse($article->created_at)->format('Y-m-d H:i') }}">
                        <span class="article__date">{{ \Carbon\Carbon::parse($article->created_at)->format('d.m') }}</span>
                        <span class="article__time">{{ \Carbon\Carbon::parse($article->created_at)->format('H:i') }}</span>
                    </time>
                    <div class="article__descr">
                        {!! strip_tags($article->shortDescription(250)) !!}
                    </div>
                </article>
            </div>
            @endforeach
        </div>
</section>
