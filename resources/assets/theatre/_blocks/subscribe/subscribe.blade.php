<section class="subscribe">
  <h3 class="subscribe__title">{{ __('subscribe.subscribe_to_news') }}</h3>
  {!! Form::open(['route' => 'front.subscribe.subscribe', 'method' => 'post', 'class' => 'subscribe__form', 'data-form-validate']) !!}
    <div class="subscribe__container">
      <input class="subscribe__form-input" type="email" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" name="email" required>
      <p class="subscribe__form-placeholder" data-text-placeholder>{{ __('subscribe.email_address') }}</p>
      <button type="submit" class="btn-buy">{{ __('subscribe.subscribe') }}</button>
    </div>
  {!! Form::close() !!}
</section>
