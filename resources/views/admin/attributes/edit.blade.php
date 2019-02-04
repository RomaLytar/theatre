@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.editAttribute')}}</h1>
  </div>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::model($attribute, ['route' => array('attributes.update', $attribute->id), 'method' => 'PUT']) }}

  <div class="row">
    <div class="col-md-6 form-group">
      {{ Form::label('name', __('admin.attributeName')) }}
      {{ Form::text('name', $attribute->name ?? Input::old('name'), ['class' => 'form-control' ]) }}
    </div>
  </div>

  {{ Form::submit('Update', ['class' => 'btn btn-success']) }}

  {{ Form::close() }}
@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
  {!! Html::script('js/plugins/mask.min.js') !!}
  {!! Html::script('js/plugins/moment.min.js') !!}
@stop
