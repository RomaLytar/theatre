<div class="lang" data-lang>
  {{Form::open(['url' => 'language/change', 'method' => 'post', 'class' => 'visually-hidden', 'data-lang-form'])}}
  {{ Form::select('locale') }}
  {{ Form::close() }}
  <ul class="lang__list" data-lang-list>
    <li {{ session('locale') === 'en' ? 'class=lang__list-active' : '' }}><a href="en">{{ __('home.en') }}</a></li>
    <li {{ session('locale') === 'ru' ? 'class=lang__list-active' : '' }}><a href="ru">{{ __('home.ru') }}</a></li>
    <li {{ session('locale') === 'ua' ? 'class=lang__list-active' : '' }}><a href="ua">{{ __('home.ua') }}</a></li>
  </ul>
</div>
