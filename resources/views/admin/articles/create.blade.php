@extends('layouts.admin')
@section('content')
    <div class="df mb15">
      <h1 class="global__page-title">{{__('admin.createArticle')}}</h1>
    </div>

    {{ Html::ul($errors->all()) }}

    {{ Form::open(['url' => '/admin/articles', 'files'=>true, 'id' => 'create-article']) }}
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
              {{ Form::label('title_en', __('article.title')) }}
              {{ Form::text('title_en', Input::old('title_en'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('descriptions_en', __('article.descriptions')) }}
              {{ Form::textarea('descriptions_en',  Input::old('descriptions_en'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_en', __('seo.seo_title')) }}
              {{ Form::text('seo_title_en', Input::old('seo_title_en'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_en', __('seo.seo_description')) }}
              {{ Form::text('seo_description_en', Input::old('seo_description_en'), ['class' => 'form-control']) }}
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ru">
          <div class="row">
            <div class="col-md-6 form-group">
              {{ Form::label('title_ru', __('article.title')) }}
              {{ Form::text('title_ru',Input::old('title_ru'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('descriptions_ru', __('article.descriptions')) }}
              {{ Form::textarea('descriptions_ru',Input::old('descriptions_ru'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_ru', __('seo.seo_title')) }}
              {{ Form::text('seo_title_ru', Input::old('seo_title_ru'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_ru', __('seo.seo_description')) }}
              {{ Form::text('seo_description_ru', Input::old('seo_description_ru'), ['class' => 'form-control']) }}
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ua">
          <div class="row">
            <div class="col-md-6 form-group">
              {{ Form::label('title_ua', __('article.title')) }}
              {{ Form::text('title_ua', Input::old('title_ua'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('descriptions_ua', __('article.descriptions')) }}
              {{ Form::textarea('descriptions_ua', Input::old('descriptions_ua'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_ua', __('seo.seo_title')) }}
              {{ Form::text('seo_title_ua', Input::old('seo_title_ua'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_ua', __('seo.seo_description')) }}
              {{ Form::text('seo_description_ua', Input::old('seo_description_ua'), ['class' => 'form-control']) }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group">
        {{ Form::label('actors[]', __('article.actors')) }}
        {{ Form::select('actors[]', [], null, ['class' => 'form-control']) }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::label('performances[]', __('article.performances')) }}
        {{ Form::select('performances[]', [], null, ['class' => 'form-control']) }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::label('category_id', __('article.category')) }}
        {{ Form::select('category_id', $articleCategories, Input::old('category_id'), ['class' => 'form-control']) }}
      </div>
    </div>

    <div class="panel panel-success">
      <div class="panel-heading">{{ __('admin.media') }}</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6 form-group">
            <div class="file-load" data-file>
              <label class="file-load__label">
                {{Form::file('poster', ['class'=>'visually-hidden', 'data-file-input', 'accept'=>'image/*'])}}
                <span class="file-load__text">{{ __('video.poster') }}</span>
              </label>

              <div class="file-load__list" data-file-list></div>

              <button type="button" class="btn btn-success" data-file-btn>
                <span class="glyphicon glyphicon-download-alt"></span> {{ __('admin.add_img') }}
              </button>
            </div>
          </div>
          <div class="form-group col-md-12" id="video">
            {{ Form::label('videos', __('article.videos'))}}
            <input type="hidden" id="default-id" value="0">
            <div class="row" data-video-list></div>
            <a class="btn btn-success" data-video-add>{{__('article.addNewField')}}</a>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">{{__('article.images')}}</div>
      <div class="panel-body">
        <div class="file-load" data-file>
          <label class="file-load__label">
            {{Form::file('images[]', ['class'=>'visually-hidden', 'data-file-input', 'multiple', 'accept'=>'image/*'])}}
          </label>

          <div class="file-load__list" data-file-list></div>

          <button type="button" class="btn btn-success" data-file-btn>
            <span class="glyphicon glyphicon-download-alt"></span> {{ __('admin.add_img') }}
          </button>
        </div>
      </div>
    </div>

    {{ Form::submit(__('admin.create'), ['class' => 'btn btn-success']) }}

    {{ Form::close() }}
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
  {!! Html::script('/vendor/unisharp/laravel-ckeditor/ckeditor.js') !!}
  <script>
    CKEDITOR.replace( 'descriptions_en' );
    CKEDITOR.replace( 'descriptions_ru' );
    CKEDITOR.replace( 'descriptions_ua' );
  </script>
  {!! Html::script('js/admin/global.js') !!}
@stop
