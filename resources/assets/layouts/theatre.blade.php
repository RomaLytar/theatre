<!doctype html>
<html lang="{{ session('locale') }}" class="no-js">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {!! SEO::generate() !!}
  <link rel="stylesheet" href="/design/css/global.css">
  <link rel="stylesheet" href="/design/css/theatre.css">
  <link rel="stylesheet" href="/design/css/cart-global.css">
  @include('pages.global._blocks.head.head')
</head>
<body>
  @include('pages.theatre._blocks.header.header')
  @include('pages.theatre._blocks.message.message')

  <!-- content -->
    @yield('content')
  <!-- /content -->

  @include('pages.theatre._blocks.footer.footer')
  @include('pages.theatre._blocks.copyright.copyright')
  @include('pages.global._blocks.polyfills.polyfills')
  <script src="/design/js/cart-global.js"></script>
  @include('pages.theatre._blocks.bottom.bottom')
</body>
</html>
