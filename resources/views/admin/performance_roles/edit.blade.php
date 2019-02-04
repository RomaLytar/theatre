@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.editPerformanceRoles')}}</h1>
  </div>

  {{ Html::ul($errors->all()) }}

  {{ Form::model($performance, ['route' => array('performance-roles.update', $performance->id), 'method' => 'PUT']) }}

  {{ Form::hidden('performance_id', $performance->id) }}
  <div class="row">
    @foreach($actors as $actor)
      <div class="form-group col-md-6">
        {{ Form::label('actor_role_id' . '_' . $actor->id, __('admin.actor_role') . ' ' . $actor->fullName() . $actor->id) }}
        {{ Form::select($actor->id , $actorRoles, $actor->role_id, ['class' => 'form-control']) }}
      </div>
    @endforeach
  </div>

  {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}

  {{ Form::close() }}
@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
  {!! Html::script('js/plugins/mask.min.js') !!}
  {!! Html::script('js/plugins/moment.min.js') !!}

  {{--<script>--}}
   {{--[...document.querySelectorAll('select')].forEach(selectItem => {--}}
     {{--const actorId = selectItem.getAttribute(`data-actor-id`);--}}
     {{--[...selectItem.querySelectorAll('option')].forEach(optionItem => {--}}
       {{--optionItem.value = `${actorId}.${optionItem.value}`--}}
     {{--})--}}
   {{--});--}}
  {{--</script>--}}
@stop
