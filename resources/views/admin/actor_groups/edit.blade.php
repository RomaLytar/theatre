@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.editActorGroup')}}</h1>
  </div>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::model($actor_group, ['route' => array('actor_groups.update', $actor_group->id), 'method' => 'PUT']) }}
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
            {{ Form::text('title_en',isset($actor_group->translate('en')->first()->title) ? $actor_group->translate('en')->first()->title  : Input::old('title_en'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_en', __('admin.seo_title')) }}
            {{ Form::text('seo_title_en',isset($actor_group->translate('en')->first()->seo_title) ? $actor_group->translate('en')->first()->seo_title  : Input::old('seo_title_en'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_en', __('admin.seo_description')) }}
            {{ Form::text('seo_description_en',isset($actor_group->translate('en')->first()->seo_description) ? $actor_group->translate('en')->first()->seo_description  : Input::old('seo_description_en'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ru">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ru', __('admin.title')) }}
            {{ Form::text('title_ru',isset($actor_group->translate('ru')->first()->title) ? $actor_group->translate('ru')->first()->title  : Input::old('title_ru'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ru', __('admin.seo_title')) }}
            {{ Form::text('seo_title_ru',isset($actor_group->translate('ru')->first()->seo_title) ? $actor_group->translate('ru')->first()->seo_title  : Input::old('seo_title_ru'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ru', __('admin.seo_description')) }}
            {{ Form::text('seo_description_ru',isset($actor_group->translate('ru')->first()->seo_description) ? $actor_group->translate('ru')->first()->seo_description  : Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ua">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ua', __('admin.title')) }}
            {{ Form::text('title_ua',isset($actor_group->translate('ua')->first()->title) ? $actor_group->translate('ua')->first()->title  : Input::old('title_ua'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ua', __('admin.seo_title')) }}
            {{ Form::text('seo_title_ua',isset($actor_group->translate('ua')->first()->seo_title) ? $actor_group->translate('ua')->first()->seo_title  : Input::old('seo_title_ua'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ua', __('admin.seo_description')) }}
            {{ Form::text('seo_description_ua',isset($actor_group->translate('ua')->first()->seo_description) ? $actor_group->translate('ua')->first()->seo_description  : Input::old('seo_description_ua'), ['class' => 'form-control' ]) }}
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
        {{ Form::checkbox('is_active', 1, $actorGroups->is_active ?? Input::old('is_active')) }}
        <span class="global__checkbox-text">{{ __('actor.is_active') }}</span>
      </label>
    </div>
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
@stop
