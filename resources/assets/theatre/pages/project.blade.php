@extends('layouts.theatre')

@section('content')
    <div class="wrap-full">
        @include('pages.theatre._blocks.promo-low.promo-low')
    </div>
    <div class="wrap container-fluid">
        <h1 class="page-title page-title--small">{{ $project->translate->title }}</h1>
        @include('pages.theatre._blocks.description-text.description-text',['description' => $project->translate->description])
        @include('pages.theatre._blocks.form-support.form-support' , ['title' => __('pages.contribution')])
        @include('pages.theatre._blocks.articles.articles-support')
        @include('pages.theatre._blocks.description-text-title.description-text-title-support')
    </div>
    @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
