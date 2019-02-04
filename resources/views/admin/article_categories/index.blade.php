@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.articleCategoriesManagement') }}</h2>
        <div class="fsh">
            @can('article-category-create')
                <a class="btn btn-success"
                   href="{{ route('article-categories.create') }}">{{ __('admin.createNewArticleCategory') }}</a>
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
        @foreach ($articleCategories as $key => $articleCategory)
            <tr>
                <td class="global__table-short">{{ $articleCategory->id }}</td>
                <td>{{ $articleCategory->translate->title }}</td>
                <td class="global__table-short">
                    @can('article-category-edit')
                        <a class="btn btn-primary" href="{{ route('article-categories.edit',$articleCategory->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('article-category-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['article-categories.destroy', $articleCategory->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $articleCategories->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
