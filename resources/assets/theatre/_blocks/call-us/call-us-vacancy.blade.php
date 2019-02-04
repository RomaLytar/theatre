<section class="call-us">
    @if ($vacancy->translate->add_description != '')
        <h3 class="call-us__title">{{ __('pages.vacancies_conditions') }}</h3>
        <div class="call-us__descr">
            {!! $vacancy->translate->add_description !!}
        </div>
    @endif
</section>
