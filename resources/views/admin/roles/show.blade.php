@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{ __('admin.showRole') }}</h1>
    <div class="fsh">
      <a class="btn btn-primary" href="{{ route('roles.index') }}">{{ __('admin.back') }}</a>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 form-group">
      <strong>{{ __('admin.name') }}:</strong>
      {{ $role->name }}
    </div>
    <div class="col-xs-12 form-group">
      <strong>{{ __('admin.permissions') }}:</strong>
      @if(!empty($rolePermissions))
        @foreach($rolePermissions as $v)
          <label class="badge badge-success">{{ $v->name }}</label>
        @endforeach
      @endif
    </div>
    <div class="col-xs-12 form-group">
      <strong>{{ __('admin.users_with_this_role') }} ({{$users->count()}})</strong>
      @foreach($users as $user)
        <label class="badge badge-success">{{ $user->name }}</label>
      @endforeach
    </div>
  </div>
@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection
