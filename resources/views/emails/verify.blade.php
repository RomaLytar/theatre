<h1>{{ __('email.thank_you') }}</h1>
<a href="{{ route('front.subscribe.verify', ['token' => $subs->token] ) }}">{{ $subs->token }}</a>
