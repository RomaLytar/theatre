@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{ __('admin.createNewRole') }}</h1>
    <div class="fsh">
      <a class="btn btn-primary" href="{{ route('roles.index') }}">{{ __('admin.back') }}</a>
    </div>
  </div>

  @include('admin.errors')

  {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
  <div>
    <div class="form-group">
      <label for="name">{{ __('admin.name') }}:</label>
      {!! Form::text('name', null, array('placeholder' => __('admin.name'),'class' => 'form-control', 'id' => 'name')) !!}
    </div>
    <div class="form-group">
      <div>
        <label>{{ __('admin.permission') }}:</label>
      </div>

      @foreach($permission as $value)
        <label class="global__checkbox">
          {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
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

@section('scripts')
  {!! Html::script('js/admin/global.js') !!}
@stop
