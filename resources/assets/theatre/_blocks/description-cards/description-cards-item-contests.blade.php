<section class="description-cards" data-replace-social-share>
    <div class="description-cards__list">
        <div class="description-cards__item row" data-texttoggle-container>
            <div class="col col-12 col-md-4 col-xl-4 description-cards__info" data-info data-texttoggle-model>
                <figure class="description-cards__img">
                    <img src="{{ $project->getFirstMediaUrl('posters')}}" alt="{!! str_limit($project->translate->title) !!}">
                </figure>
                <div class="description-cards__share" data-replace-social-share-block>
                    @include('pages.theatre._blocks.social-share.social-share')
                </div>
            </div>

            <div class="col col-12 col-md-8 col-xl-8  description-cards__about" data-about data-texttoggle-parent>
                <div class="description-cards__descr" data-texttoggle-toggled>
                    {!! $project->translate->description !!}
                    @include('pages.theatre._blocks.btn-toggle.btn-toggle')
                </div>
            </div>
        </div>
    </div>
</section>

