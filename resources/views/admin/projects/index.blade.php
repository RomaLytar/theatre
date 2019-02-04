@extends('layouts.admin')
@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.projects') }}</h2>
        <div class="fsh">
            @can('project-category-list')
                <a class="btn btn-primary"
                   href="{{ route('project-categories.index') }}">{{ __('admin.project_cat') }}</a>
            @endcan
            @can('project-create')
                <a class="btn btn-success"
                   href="{{ route('projects.create') }}">{{ __('admin.create_new_project') }}</a>
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
        @foreach ($projects as $project)
            <tr>
                <td class="global__table-short">{{ $project->id }}</td>
                <td>{{ $project->translate->title }}</td>
                <td>{{ $project->translate->description }}</td>
                <td>{{ $project->category->translate->title }}</td>
                <td class="global__table-short"><img src="{{ $project->getFirstMediaUrl('posters','thumb') }}" alt=""
                                                     class="global__table-preview"></td>
                <td class="global__table-short">
                    @can('project-edit')
                        <a class="btn btn-primary" href="{{ route('projects.edit',$project->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('project-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {!! $projects->links() !!}
@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
