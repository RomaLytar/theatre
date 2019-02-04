@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.articlesManagement') }}</h2>
        <div class="fsh">
            @can('article-category-list')
                <a class="btn btn-primary"
                   href="{{ route('article-categories.index') }}">{{ __('admin.articleCategories') }}</a>
            @endcan
            @can('article-create')
                <a class="btn btn-success" href="{{ route('articles.create') }}">{{ __('admin.createArticle') }}</a>
            @endcan
        </div>
    </div>


    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.title') }}</th>
            <th>{{ __('admin.description') }}</th>
            <th>{{ __('admin.cat') }}</th>
            <th class="global__table-short">{{ __('admin.poster') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($articles as $article)
            <tr>
                <td class="global__table-short">{{ $article->id }}</td>
                <td>{{ $article->translate->title }}</td>
                <td>{{ str_limit($article->translate->descriptions, 100) }}</td>
                <td>{{ $article->category->translate->title }}</td>
                <td class="global__table-short"><img src="{{ $article->getFirstMediaUrl('posters', 'thumb') }}"
                                                     alt="{{ $article->translate->title }}"
                                                     class="global__table-preview"></td>
                <td class="global__table-short">
                    @can('article-edit')
                        <a class="btn btn-primary" href="{{ route('articles.edit',$article->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('article-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['articles.destroy', $article->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $articles->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
