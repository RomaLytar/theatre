@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.albumsManagement') }}</h2>
        <div class="fsh">
            @can('season-list')
                <a class="btn btn-primary" href="{{ route('seasons.index') }}">{{ __('admin.seasons') }}</a>
            @endcan
            @can('album-category-list')
                <a class="btn btn-primary"
                   href="{{ route('album-categories.index') }}">{{ __('admin.albumCategories') }}</a>
            @endcan
            @can('album-create')
                <a class="btn btn-success" href="{{ route('albums.create') }}">{{ __('admin.createNewAlbum') }}</a>
            @endcan
        </div>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.name') }}</th>
            <th class="global__table-short">{{ __('admin.poster') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($albums as $key => $album)
            <tr>
                <td class="global__table-short">{{ $album->id }}</td>
                <td>{{ $album->translate->title }}</td>
                <td class="global__table-short"><img src="{{ $album->getFirstMediaUrl('posters', 'thumb') }}"
                                                     alt="{{ $album->translate->title }}" class="global__table-preview">
                </td>
                <td class="global__table-short">
                    @can('album-edit')
                        <a class="btn btn-primary" href="{{ route('albums.edit',$album->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('album-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['albums.destroy', $album->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $albums->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
