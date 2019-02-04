@extends('layouts.theatre')

@section('content')
    <div class="wrap-full">
        @include('pages.theatre._blocks.promo-low.promo-low')
    </div>
    <div class="wrap">
        <h1 class="page-title">{{ $project->translate->title }}</h1>
        @include('pages.theatre._blocks.description-item.description-item', [ 'description' => $project->translate->description,
         'title' => $project->translate->title,
         'imageUrl' => $project->getFirstMediaUrl('posters')])
    </div>

    @include('pages.theatre._blocks.subscribe.subscribe')
@endsection

