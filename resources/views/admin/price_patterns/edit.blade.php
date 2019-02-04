@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">Редагувати ціновий шаблон</h1>
  </div>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::model($pricePattern, ['route' => array('price-patterns.update', $pricePattern->id), 'method' => 'PUT']) }}
  <div>
    <div class="form-group">
      {{ Form::label('title', 'Назва шаблону') }}
      {{ Form::text('title', $pricePattern->title ?? Input::old('title'), ['class' => 'form-control']) }}
    </div>
  </div>
  {{ Form::submit('Оновити', ['class' => 'btn btn-success']) }}

  <a class="btn btn-warning " href="{{ route('album-categories.index') }}">{{ __('admin.cancel') }}</a>
@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
  {!! Html::script('js/plugins/mask.min.js') !!}
  {!! Html::script('js/plugins/moment.min.js') !!}
@stop
