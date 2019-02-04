<section class="description-cards">
    <div class="description-cards__list">
        <div class="description-cards__item row" data-texttoggle-container>
            <div class="col col-12 col-md-4 col-xl-4 description-cards__info" data-texttoggle-model>
                <figure class="description-cards__img">
                    <img src="{{ $block->getFirstMediaUrl('posters')}}" alt="{!! str_limit($block->translate->title) !!}">
                </figure>
            </div>
            <div class="col col-12 col-md-8 col-xl-8 description-cards__about" data-texttoggle-parent>
                <div class="description-cards__descr" data-texttoggle-toggled>
                    {!! $block->translate->descriptions !!}
                    @include('pages.theatre._blocks.btn-toggle.btn-toggle')
                </div>
            </div>
        </div>
    </div>
</section>

