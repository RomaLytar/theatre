@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{ __('admin.create_new_permission') }}</h1>
    <div class="fsh">
      <a class="btn btn-primary" href="{{ route('permissions.index') }}"> {{ __('admin.cancel') }}</a>
    </div>
  </div>

  @include('admin.errors')

  {!! Form::open(array('route' => 'permissions.store','method'=>'POST', 'permission' => 'permission-create')) !!}
  <div>
    <div class="form-group">
      {{ Form::label('name', __('admin.name'))}}
      {!! Form::text('name', null, array('placeholder' => __('admin.name'),'class' => 'form-control')) !!}
    </div>
    <div class="form-group">
      @if(!$roles->isEmpty())
        <h4>{{ __('admin.assign_permission') }}</h4>
        @foreach ($roles as $role)
          <label class="global__checkbox">
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{-- Form::label($role->name, ucfirst($role->name)) --}}
            <span class="global__checkbox-text">{{ $role->name }}</span>
          </label>
        @endforeach
      @endif
    </div>
    <div>
      {{ Form::submit(__('admin.add'), array('class' => 'btn btn-success')) }}
    </div>
  </div>
  {!! Form::close() !!}
@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection
