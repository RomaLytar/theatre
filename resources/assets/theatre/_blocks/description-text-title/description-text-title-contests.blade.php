<section class="description-text-title">
    @if ($project->translate->cond_description != '')
        <h2 class="description-text-title__title">{{ __('pages.conditions') }}</h2>
        <div class="description-text-title__wraper">
        {!! $project->translate->cond_description !!}
        </div>
    @endif
</section>