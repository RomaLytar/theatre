@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.createNewSetting')}}</h1>
  </div>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::open(['url' => '/admin/settings', 'id' => 'create-title']) }}

  <div>
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#en" aria-controls="home" role="tab" data-toggle="tab">EN</a></li>
      <li role="presentation"><a href="#ru" aria-controls="profile" role="tab" data-toggle="tab">RU</a></li>
      <li role="presentation"><a href="#ua" aria-controls="messages" role="tab" data-toggle="tab">UA</a></li>
    </ul>

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="en">
        <div class="form-group">
          {{ Form::label('title_en', __('admin.settingTitle')) }}
          {{ Form::text('title_en', Input::old('title_en'), ['class' => 'form-control']) }}
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ru">
        <div class="form-group">
          {{ Form::label('title_ru', __('admin.settingTitle')) }}
          {{ Form::text('title_ru', Input::old('title_ru'), ['class' => 'form-control']) }}
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ua">
        <div class="form-group">
          {{ Form::label('title_ua', __('admin.settingTitle')) }}
          {{ Form::text('title_ua', Input::old('title_ua'), ['class' => 'form-control']) }}
        </div>
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('slug', __('admin.settingSlug')) }}
      {{ Form::text('slug', Input::old('slug'), ['class' => 'form-control']) }}
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
