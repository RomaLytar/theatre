@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.editAlbumCategory')}}</h1>
  </div>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::model($albumCategory, ['route' => array('album-categories.update', $albumCategory->id), 'method' => 'PUT']) }}
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
            {{ Form::label('title_en', __('album.title')) }}
            {{ Form::text('title_en',isset($albumCategory->translate('en')->first()->title) ? $albumCategory->translate('en')->first()->title  : Input::old('title_en'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_en', __('seo.seo_title')) }}
            {{ Form::text('seo_title_en',isset($albumCategory->translate('en')->first()->seo_title) ? $albumCategory->translate('en')->first()->seo_title  : Input::old('seo_title_en'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_en', __('seo.seo_description')) }}
            {{ Form::text('seo_description_en',isset($albumCategory->translate('en')->first()->seo_description) ? $albumCategory->translate('en')->first()->seo_description  : Input::old('seo_description_en'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ru">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ru', __('album.title')) }}
            {{ Form::text('title_ru',isset($albumCategory->translate('ru')->first()->title) ? $albumCategory->translate('ru')->first()->title  : Input::old('title_ru'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ru', __('seo.seo_title')) }}
            {{ Form::text('seo_title_ru',isset($albumCategory->translate('ru')->first()->seo_title) ? $albumCategory->translate('ru')->first()->seo_title  : Input::old('seo_title_ru'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ru', __('seo.seo_description')) }}
            {{ Form::text('seo_description_ru',isset($albumCategory->translate('ru')->first()->seo_description) ? $albumCategory->translate('ru')->first()->seo_description  : Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ua">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ua', __('album.title')) }}
            {{ Form::text('title_ua',isset($albumCategory->translate('ua')->first()->title) ? $albumCategory->translate('ua')->first()->title  : Input::old('title_ua'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ua', __('seo.seo_title')) }}
            {{ Form::text('seo_title_ua',isset($albumCategory->translate('ua')->first()->seo_title) ? $albumCategory->translate('ua')->first()->seo_title  : Input::old('seo_title_ua'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ua', __('seo.seo_description')) }}
            {{ Form::text('seo_description_ua',isset($albumCategory->translate('ua')->first()->seo_description) ? $albumCategory->translate('ua')->first()->seo_description  : Input::old('seo_description_ua'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}

  <a class="btn btn-warning " href="{{ route('album-categories.index') }}">{{ __('admin.cancel') }}</a>
@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
  {!! Html::script('js/plugins/mask.min.js') !!}
  {!! Html::script('js/plugins/moment.min.js') !!}
@stop
