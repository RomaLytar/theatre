@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title page-title--small">{{ $page->translate->title }}</h1>
    @include('pages.theatre._blocks.description-text.description-text', ['description' => $page->translate->descriptions])
    @include('pages.theatre._blocks.team.team-members-vertical.team-members-vertical-style', [
    'has_title' => false,
    'has_merit' => true,
    'actors' => $actors
    ])
  </div>
  {{ $actors->links('pages.theatre._blocks.pagination.pagination') }}
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
