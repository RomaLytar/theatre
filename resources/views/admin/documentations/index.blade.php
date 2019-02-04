@extends('layouts.admin')
@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.doc') }}</h2>
        <div class="fsh">
            @can('doc-category-list')
                <a class="btn btn-primary"
                   href="{{ route('documentation-categories.index') }}">{{ __('admin.doc_cat') }}</a>
            @endcan
            @can('doc-create')
                <a class="btn btn-success"
                   href="{{ route('documentations.create') }}">{{ __('admin.create_new_doc') }}</a>
            @endcan
        </div>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.title') }}</th>
            <th>{{ __('admin.cat') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($documentations as $documentation)
            <tr>
                <td class="global__table-short">{{ $documentation->id }}</td>
                <td>{{ $documentation->translate->title }}</td>
                <td>{{ $documentation->category->translate->title }}</td>
                <td class="global__table-short">
                    @can('doc-category-edit')
                        <a class="btn btn-primary" href="{{ route('documentations.edit',$documentation->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('doc-category-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['documentations.destroy', $documentation->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
