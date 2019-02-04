@extends('layouts.admin')

@section('content')
   <div class="df mb15">
    <h1 class="global__page-title">{{ __('admin.edit_permission') }}</h1>
    <div class="fsh">
      <a class="btn btn-primary" href="{{ route('permissions.index') }}"> {{ __('admin.back') }}</a>
    </div>
  </div>

  @include('admin.errors')

  {!! Form::model($permission, ['method' => 'PATCH','route' => ['permissions.update', $permission->id]]) !!}
  <div>
    <div class="form-group">
      {{ Form::label('name', __('admin.permission_name')) }}
      {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
    </div>
    {{ Form::submit(__('admin.edit'), array('class' => 'btn btn-success')) }}
  </div>
  {!! Form::close() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection
