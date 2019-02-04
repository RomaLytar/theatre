<section name="articles" class="articles">
    <h2 class="articles__title">{{ __('pages.project_support') }}</h2>
    <div class="row articles__row" data-slick-slider>
        @foreach($projects as $project)
            <div class="col col-sm-6 col-xl-4" data-slider-item>
                <article class="article">
                    <figure class="article__img">
                        <img src="{{ $project->getFirstMediaUrl('posters', 'preview') }}" alt="">
                    </figure>
                    <h3 class="article__title">
                        <a href="">{{$project->translate->title}}</a>
                    </h3>
                    <div class="article__descr">
                        <p>{{ str_limit($project->translate->description, 200) }}</p>
                    </div>
                    <a href="{{ route('front.projects.show',['id' => $project->id, 'slug' => $project->translate->slug]) }}" class="btn-more-link">{{ __('pages.learn_more') }}</a>
                </article>
            </div>
        @endforeach
    </div>
</section>
