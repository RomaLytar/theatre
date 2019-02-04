<section class="form-support">
  <h2 class="form-support__title">{{ $title }}</h2>
  <form class="form-support__form" action="{{ $paymentData['action'] }}" method="POST" name="contact">
    <input type="hidden" name="data" value="{{ $paymentData['data'] }}">
    <input type="hidden" name="signature" value="{{ $paymentData['signature'] }}">
    <input class="form-support__input" placeholder="{{ __('pages.amount') }}" type="text" minlength="1"  pattern="^[ 0-9]+$" name="name" title="Field must contains only numbers" required>
    <button type="submit" class="btn-more btn-more--gold btn-more--long btn-more--uppercase ">{{ __('pages.donation') }}</button>
  </form>
</section>
