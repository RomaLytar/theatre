@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.createAttribute')}}</h1>
  </div>

  {{ Html::ul($errors->all()) }}

  {{ Form::open(['url' => '/admin/attributes', 'files' => true, 'id' => 'create-attribute']) }}

  <div class="row">
    <div class="col-md-6 form-group">
      {{ Form::label('name', __('admin.attributeName')) }}
      {{ Form::text('name', Input::old('name'), ['class' => 'form-control']) }}
    </div>
  </div>

  {{ Form::submit('Create', ['class' => 'btn btn-success']) }}

  {{ Form::close() }}
@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
  {!! Html::script('js/plugins/mask.min.js') !!}
  {!! Html::script('js/plugins/moment.min.js') !!}
@stop
