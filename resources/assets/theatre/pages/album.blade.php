@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    {{-- {{ Breadcrumbs::render('album_item', $album) }} --}}
    <h1 class="page-title page-title--not-marg-bot">{{ $album->translate->title }}</h1>
    @include('pages.theatre._blocks.photo-album.photo-album', ['album' => $album, 'photos' => $photos])
    @include('pages.theatre._blocks.pagination.pagination-simple', ['currentPage' => $photos->currentPage(), 'lastPage' => $photos->lastPage()])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
