<!doctype html>
<html lang="{{ session('locale') }}" class="no-js">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {!! SEO::generate() !!}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="/design/css/tickets-designer.css">
  @include('pages.global._blocks.head.head')
</head>
<body>
  {{ csrf_field() }}
  <div id="app"></div>

  <script src="/design/js/tickets-designer.js"></script>
</body>
</html>
