@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{ __('admin.editRole') }}</h1>
    <div class="fsh">
      <a class="btn btn-primary" href="{{ route('roles.index') }}">{{ __('admin.back') }}</a>
    </div>
  </div>

  @include('admin.errors')

  {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
  <div>
    <div class="form-group">
      <label for="name">{{ __('admin.name') }}:</label>
      {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'id' => 'name')) !!}
    </div>
    <div class="form-group">
      <div>
        <label>{{ __('admin.permission') }}:</label>
      </div>

      @foreach($permission as $value)
        <label class="global__checkbox">
          {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
          <span class="global__checkbox-text">{{ $value->name }}</span>
        </label>
      @endforeach
    </div>
    <button type="submit" class="btn btn-success">{{ __('admin.submit') }}</button>
  </div>
  {!! Form::close() !!}

@endsection

@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
