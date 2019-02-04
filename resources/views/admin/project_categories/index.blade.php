@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h2 class="global__page-title">{{ __('admin.project_cat') }}</h2>
    <div class="fsh">
      {{--@can('album-create')--}}
        <a class="btn btn-success" href="{{ route('project-categories.create') }}">{{ __('admin.create_new_cat_project') }}</a>
      {{--@endcan--}}
    </div>
  </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.name') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($projectCategories as $key => $projectCategory)
            <tr>
                <td class="global__table-short">{{ $projectCategory->id }}</td>
                <td>{{ $projectCategory->translate->title }}</td>
                <td class="global__table-short">
                    {{--@can('permission-edit')--}}
                    <a class="btn btn-primary" href="{{ route('project-categories.edit',$projectCategory->id) }}"><i class="fa fa-pencil"></i></a>
                    {{--@endcan--}}
                    {{--@can('permission-delete')--}}
                    {{ Form::open(['method' => 'DELETE', 'route' => ['project-categories.destroy', $projectCategory->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                    {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                    {{ Form::close() }}
                    {{--@endcan--}}
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
