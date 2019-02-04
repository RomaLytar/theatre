@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.albumCategoriesManagement') }}</h2>
        <div class="fsh">
            @can('album-category-create')
                <a class="btn btn-success"
                   href="{{ route('album-categories.create') }}">{{ __('admin.createNewAlbumCategory') }}</a>
            @endcan
        </div>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.name') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($albumCategories as $key => $albumCategory)
            <tr>
                <td class="global__table-short">{{ $albumCategory->id }}</td>
                <td>{{ $albumCategory->translate->title }}</td>
                <td class="global__table-short">
                    @can('album-category-edit')
                        <a class="btn btn-primary" href="{{ route('album-categories.edit',$albumCategory->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('album-category-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['album-categories.destroy', $albumCategory->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $albumCategories->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
