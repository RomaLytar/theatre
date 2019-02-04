@extends('layouts.theatre')

@section('content')
  <div class="wrap container-fluid">
    @include('pages.theatre._blocks.articles.articles-tour')
    @include('pages.theatre._blocks.media.media')
    @include('pages.theatre._blocks.articles.articles')
  </div>
@endsection

{{-- Наверное, не используется--}}
