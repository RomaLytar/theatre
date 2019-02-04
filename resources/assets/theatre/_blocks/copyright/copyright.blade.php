<div class="copyright">
  <div class="wrap">
    <div class="container-fluid">
      <div class="row">
        <p class="col col-md-4 col-12">&#169;<span id="year-current">{{ \Illuminate\Support\Carbon::now()->format('Y') }}</span> {{ __('footer.sitename') }}. {{ __('footer.copyright') }}
        </p>
        <p class="col col-md-4 col-12 copyright__info-container">
          <a href="{{ setting(session('locale') . '.' . 'official_information_url') }}" class="copyright__info">{{ __('footer.official_information') }}</a>
        </p>
        <p class="col col-md-4 col-12">
          {{ __('footer.created_by') }} <a href="{{ __('.footer.develop_company_url') }}" class="copyright__info copyright__info--no-decorate">{{ __('footer.develop_company_name') }}</a>
        </p>
      </div>
    </div>
  </div>
</div>
