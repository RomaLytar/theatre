@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    <h1 class="page-title">{{ __('pages.creative_projects') }}</h1>
    @include('pages.theatre._blocks.tabs.tabs-creative')
    @include('pages.theatre._blocks.description-cards.description-cards-simple',[ 'description' => $project->translate->description,
     'title' => $project->translate->title,
     'imageUrl' => $project->getFirstMediaUrl('posters','preview'),
     'hasTitle' => '',])
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection

