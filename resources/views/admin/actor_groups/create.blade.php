@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.createNewActorGroup')}}</h1>
  </div>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::open(['url' => '/admin/actor_groups', 'id' => 'create-actor-group']) }}
  <div>
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#en" aria-controls="home" role="tab" data-toggle="tab">EN</a></li>
      <li role="presentation"><a href="#ru" aria-controls="profile" role="tab" data-toggle="tab">RU</a></li>
      <li role="presentation"><a href="#ua" aria-controls="messages" role="tab" data-toggle="tab">UA</a></li>
    </ul>

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="en">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_en', __('admin.title')) }}
            {{ Form::text('title_en', Input::old('title_en'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_en', __('admin.seo_title')) }}
            {{ Form::text('seo_title_en', Input::old('seo_title_en'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_en', __('admin.seo_description')) }}
            {{ Form::text('seo_description_en', Input::old('seo_description_en'), ['class' => 'form-control']) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ru">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ru', __('admin.title')) }}
            {{ Form::text('title_ru', Input::old('title_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ru', __('admin.seo_title')) }}
            {{ Form::text('seo_title_ru', Input::old('seo_title_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ru', __('admin.seo_description')) }}
            {{ Form::text('seo_description_ru', Input::old('seo_description_ru'), ['class' => 'form-control']) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ua">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ua', __('admin.title')) }}
            {{ Form::text('title_ua', Input::old('title_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ua', __('admin.seo_title')) }}
            {{ Form::text('seo_title_ua', Input::old('seo_title_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ua', __('admin.seo_description')) }}
            {{ Form::text('seo_description_ua', Input::old('seo_description_ua'), ['class' => 'form-control']) }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-6">
      {{ Form::label('parent_id', __('admin.actor_parent_group')) }}
      {{ Form::select('parent_id', $actorGroups, Input::old('parent_id'), ['class' => 'form-control', 'placeholder' => 'Выберите из списка']) }}
    </div>

    <div class="form-group col-md-12">
      <label class="global__checkbox">
        {{ Form::checkbox('is_active', 1, true) }}
        <span class="global__checkbox-text">{{ __('actor.is_active_group') }}</span>
      </label>
    </div>
  </div>

  {{ Form::submit(__('admin.create'), ['class' => 'btn btn-success']) }}

  {{ Form::close() }}
@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
  {!! Html::script('js/plugins/mask.min.js') !!}
  {!! Html::script('js/plugins/moment.min.js') !!}
@stop
