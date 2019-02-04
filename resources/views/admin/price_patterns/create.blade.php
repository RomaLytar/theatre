@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">Створення цінового шаблону</h1>
  </div>

  {{ Html::ul($errors->all()) }}

  {{ Form::open(['url' => '/admin/price-patterns', 'files' => true, 'id' => 'create-price-pattern']) }}

  <div>
    <div class="form-group">
      {{ Form::label('title', 'Назва шаблону') }}
      {{ Form::text('title', Input::old('title'), ['class' => 'form-control']) }}
    </div>
  </div>

  {{ Form::submit('Створити', ['class' => 'btn btn-success']) }}

  {{ Form::close() }}
@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
  {!! Html::script('js/plugins/mask.min.js') !!}
  {!! Html::script('js/plugins/moment.min.js') !!}
@stop
