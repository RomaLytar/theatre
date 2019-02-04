@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title">{{ __('pages.electronic_edition') }}</h1>
    <div class="row section-margin-bottom">
      @foreach($ebooks as $ebook)
      <div class="col-sm-6 col-md-4 col-xl-3">
        @include('pages.theatre._blocks.ebooks-item.ebooks-item')
      </div>
      @endforeach
    </div>
  </div>
  {{ $ebooks->links('pages.theatre._blocks.pagination.pagination') }}
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection

