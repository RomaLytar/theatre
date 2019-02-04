@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.editVideo')}}</h1>
  </div>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::model($video, ['route' => array('videos.update', $video->id), 'method' => 'PUT', 'files' => true]) }}
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
            {{ Form::label('title_en', __('video.title')) }}
            {{ Form::text('title_en',isset($video->translate('en')->first()->title) ? $video->translate('en')->first()->title  : Input::old('title_en'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_en', __('seo.seo_title')) }}
            {{ Form::text('seo_title_en',isset($video->translate('en')->first()->seo_title) ? $video->translate('en')->first()->seo_title  : Input::old('seo_title_en'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_en', __('seo.seo_description')) }}
            {{ Form::text('seo_description_en',isset($video->translate('en')->first()->seo_description) ? $video->translate('en')->first()->seo_description  : Input::old('seo_description_en'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ru">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ru', __('video.title')) }}
            {{ Form::text('title_ru',isset($video->translate('ru')->first()->title) ? $video->translate('ru')->first()->title  : Input::old('title_ru'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ru', __('seo.seo_title')) }}
            {{ Form::text('seo_title_ru',isset($video->translate('ru')->first()->seo_title) ? $video->translate('ru')->first()->seo_title  : Input::old('seo_title_ru'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ru', __('seo.seo_description')) }}
            {{ Form::text('seo_description_ru',isset($video->translate('ru')->first()->seo_description) ? $video->translate('ru')->first()->seo_description  : Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ua">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ua', __('video.title')) }}
            {{ Form::text('title_ua',isset($video->translate('ua')->first()->title) ? $video->translate('ua')->first()->title  : Input::old('title_ua'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ua', __('seo.seo_title')) }}
            {{ Form::text('seo_title_ua',isset($video->translate('ua')->first()->seo_title) ? $video->translate('ua')->first()->seo_title  : Input::old('seo_title_ua'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ua', __('seo.seo_description')) }}
            {{ Form::text('seo_description_ua',isset($video->translate('ua')->first()->seo_description) ? $video->translate('ua')->first()->seo_description  : Input::old('seo_description_ua'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group">
        {{ Form::label('actors[]', __('video.actors')) }}
        {{ Form::select('actors[]', [], null, ['class' => 'form-control', 'data-selected' => json_encode($selectedActors)]) }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::label('performances[]', __('video.performances')) }}
        {{ Form::select('performances[]', [], null, ['class' => 'form-control', 'data-selected' => json_encode($selectedPerformances)]) }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::label('category_id', __('video.category')) }}
        {{ Form::select('category_id', $videoCategories, Input::old('category_id'), ['class' => 'form-control']) }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::label('season_id', __('album.category')) }}
        {{ Form::select('season_id', $seasons, Input::old('season_id'), ['class' => 'form-control']) }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::label('url', __('video.url')) }}
        {{ Form::text('url', isset($video->url) ? $video->url  : Input::old('url'), ['class' => 'form-control' ]) }}
      </div>
      <div class="col-md-6 form-group">
        <div class="file-load" data-file>
          <label class="file-load__label">
            {{Form::file('poster', ['class'=>'visually-hidden', 'data-file-input', 'accept'=>'image/*'])}}
            <span class="file-load__text">{{ __('admin.photo') }}</span>
          </label>

          <div class="file-load__list" data-file-list>
            @if($video->getFirstMediaUrl('posters', 'thumb'))
              <ul>
                <li>
                  <img src="{{$video->getFirstMediaUrl('posters', 'thumb')}}" alt="photo">
                  <button type="button" class="btn btn-danger" data-file-remove="true">
                    <span class="fa fa-trash"></span>
                  </button>
                </li>
              </ul>
            @endif
          </div>

          <button type="button" class="btn btn-success" data-file-btn>
            <span class="glyphicon glyphicon-download-alt"></span> {{ __('admin.add_img') }}
          </button>
        </div>
      </div>
    </div>
  </div>

  {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}

  <a class="btn btn-warning " href="{{ route('videos.index') }}">{{ __('admin.cancel') }}</a>
@endsection
@section('styles')
  {!! Html::style('css/select2.min.css') !!}
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
  {!! Html::script('js/plugins/mask.min.js') !!}
  {!! Html::script('js/plugins/moment.min.js') !!}
  {!! Html::script('js/plugins/select2.min.js') !!}
  {!! Html::script('js/admin/select2.js') !!}
  {!! Html::script('js/admin/article.js') !!}
   {!! Html::script('js/admin/global.js') !!}
@stop
