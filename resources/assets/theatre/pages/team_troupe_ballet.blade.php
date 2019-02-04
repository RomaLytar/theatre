@extends('layouts.theatre')

@section('content')
  <div class="wrap-full">
    @include('pages.theatre._blocks.promo-low.promo-low')
  </div>
  <div class="wrap container-fluid">
    {{-- @include('pages.theatre._blocks.breadcrumbs.breadcrumbs') --}} {{-- this block make error --}}

    <h1 class="page-title page-title--small">{{ __('pages.opera_command') }}</h1>
    @include('pages.theatre._blocks.tabs.tabs', ['items' => $groups, 'activeItem' => 'troupe'])
    @include('pages.theatre._blocks.tabs.tabs-second', ['items' => $currentGroup->parent_group->children_groups])
    @foreach($currentGroup->children_groups as $group)
      @if(in_array($group->name, ['managers', 'teachers'], true))
        @include('pages.theatre._blocks.team.team-members-vertical.team-members-vertical', [
        'has_title' => true,
        'has_merit' => true,
        'title' => $group->translate->title,
        'actors' => $group->actors,
        'actorsTroupe' => true
        ])
      @else
        @include('pages.theatre._blocks.team.team-members.team-members', [
        'has_title' => true,
        'title' => $group->translate->title,
        'actors' => $group->actors,
      ])
      @endif
    @endforeach
  </div>
  @include('pages.theatre._blocks.subscribe.subscribe')
@endsection
