<!doctype html>
<html lang="{{ session('locale') }}" class="no-js">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate() !!}
    <link rel="stylesheet" href="/design/css/concierge.css">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=latin,cyrillic" rel="stylesheet">

    @include('pages.global._blocks.head.head')
  </head>
  <body>

    <!-- content -->
      @yield('content')
    <!-- /content -->

    <script src="/design/js/concierge.js"></script>
  </body>
</html>
