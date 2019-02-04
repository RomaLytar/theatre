<!doctype html>
<html lang="{{ session('locale') }}" class="no-js">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {!! SEO::generate() !!}
  <link rel="stylesheet" href="/design/css/ticket.css">
  <link rel="stylesheet" href="/design/css/cart-global.css">
  @include('pages.global._blocks.head.head')
</head>
<body>
  <div id="app"></div>
  <script src="/design/js/cart-global.js"></script>
  <script src="/design/js/ticket.js"></script>
</body>
</html>
