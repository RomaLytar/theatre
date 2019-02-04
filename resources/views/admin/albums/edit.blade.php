@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.editAlbum')}}</h1>
  </div>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::model($album, ['route' => array('albums.update', $album->id), 'method' => 'PUT', 'files' => true]) }}
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
            {{ Form::text('title_en',isset($album->translate('en')->first()->title) ? $album->translate('en')->first()->title  : Input::old('title_en'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_en', __('seo.seo_title')) }}
            {{ Form::text('seo_title_en',isset($album->translate('en')->first()->seo_title) ? $album->translate('en')->first()->seo_title  : Input::old('seo_title_en'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_en', __('seo.seo_description')) }}
            {{ Form::text('seo_description_en',isset($album->translate('en')->first()->seo_description) ? $album->translate('en')->first()->seo_description  : Input::old('seo_description_en'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ru">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ru', __('album.title')) }}
            {{ Form::text('title_ru',isset($album->translate('ru')->first()->title) ? $album->translate('ru')->first()->title  : Input::old('title_ru'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ru', __('seo.seo_title')) }}
            {{ Form::text('seo_title_ru',isset($album->translate('ru')->first()->seo_title) ? $album->translate('ru')->first()->seo_title  : Input::old('seo_title_ru'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ru', __('seo.seo_description')) }}
            {{ Form::text('seo_description_ru',isset($album->translate('ru')->first()->seo_description) ? $album->translate('ru')->first()->seo_description  : Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ua">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ua', __('album.title')) }}
            {{ Form::text('title_ua',isset($album->translate('ua')->first()->title) ? $album->translate('ua')->first()->title  : Input::old('title_ua'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ua', __('seo.seo_title')) }}
            {{ Form::text('seo_title_ua',isset($album->translate('ua')->first()->seo_title) ? $album->translate('ua')->first()->seo_title  : Input::old('seo_title_ua'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ua', __('seo.seo_description')) }}
            {{ Form::text('seo_description_ua',isset($album->translate('ua')->first()->seo_description) ? $album->translate('ua')->first()->seo_description  : Input::old('seo_description_ua'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 form-group">
      {{ Form::label('category_id', __('album.category')) }}
      {{ Form::select('category_id', $albumCategories, Input::old('category_id'), ['class' => 'form-control']) }}
    </div>
    <div class="col-md-6 form-group">
      {{ Form::label('season_id', __('album.category')) }}
      {{ Form::select('season_id', $seasons, Input::old('season_id'), ['class' => 'form-control']) }}
    </div>
    <div class="col-md-6 form-group">
      {{ Form::label('actors[]', __('video.actors')) }}
      {{ Form::select('actors[]', [], null, ['class' => 'form-control', 'data-selected' => json_encode($selectedActors)]) }}
    </div>
    <div class="col-md-6 form-group">
      {{ Form::label('performances[]', __('video.performances')) }}
      {{ Form::select('performances[]', [], null, ['class' => 'form-control', 'data-selected' => json_encode($selectedPerformances)]) }}
    </div>
    <div class="col-md-6 form-group">
      <div class="file-load" data-file>
        <label class="file-load__label">
          {{Form::file('poster', ['class'=>'visually-hidden', 'data-file-input', 'accept'=>'image/*'])}}
          <span class="file-load__text">{{ __('album.photo') }}</span>
        </label>

        <div class="file-load__list" data-file-list>
          @if($album->getFirstMediaUrl('posters', 'thumb'))
            <ul>
              <li>
                <img src="{{$album->getFirstMediaUrl('posters', 'thumb')}}" alt="photo">
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

  <div class="panel panel-primary">
    <div class="panel-heading">{{__('album.images')}}</div>
    <div class="panel-body">
      <div class="file-load" data-file>
        <label class="file-load__label">
          {{Form::file('images[]', ['class'=>'visually-hidden', 'data-file-input', 'multiple', 'accept'=>'image/*'])}}
        </label>

        <div class="file-load__list" data-file-list>
          <ul>
            @foreach($album->getMedia('album-images') as $image)
              <li>
                {{ Form::hidden('uploadedImages[]', $image->id, ['id' => null]) }}
                <img src="{{ $image->getUrl('preview') }}" data-id="{{ $image->id }}">
                <button type="button" class="btn btn-danger" data-file-remove="true">
                  <span class="fa fa-trash"></span>
                </button>
              </li>
            @endforeach
          </ul>
        </div>

        <button type="button" class="btn btn-success" data-file-btn>
          <span class="glyphicon glyphicon-download-alt"></span> {{ __('admin.add_img') }}
        </button>
      </div>
    </div>
  </div>

  {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}
  <a class="btn btn-warning " href="{{ route('albums.index') }}">{{ __('admin.cancel') }}</a>
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
