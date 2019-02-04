@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{ __('admin.rolesManagement') }}</h1>
    <div class="fsh">
      @can('user-role-create')
        <a class="btn btn-success" href="{{ route('roles.create') }}">{{ __('admin.create') }}</a>
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
    @foreach ($roles as $key => $role)
      <tr>
        <td class="global__table-short">{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td class="global__table-short">
          <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}"><i class="fa fa-cog"></i></a>
          @can('user-role-edit')
            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-pencil"></i></a>
          @endcan
          @can('user-role-delete')
            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ]) !!}
            {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
          @endcan
        </td>
      </tr>
    @endforeach
  </table>

  {!! $roles->render() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
  {!! Html::script('js/admin/global.js') !!}
@stop
