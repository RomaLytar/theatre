@extends('layouts.admin')
@section('content')
    <div class="df mb15">
      <h1 class="global__page-title">{{__('admin.edit_program')}}</h1>
    </div>

    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($program, array('route' => array('programs.update', $program->id),'files'=>true, 'method' => 'PUT')) }}
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
              {{ Form::text('title_en',isset($program->translate->title) ? $program->translate->title  : Input::old('title_en'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_en', __('admin.description')) }}
              {{ Form::textarea('description_en',isset($program->translate->description) ? $program->translate->description : Input::old('description_en'), ['class' => 'form-control', 'data-ckeditor'  ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('terms_description_en', __('admin.terms')) }}
              {{ Form::textarea('terms_description_en',isset($program->translate->terms_description) ? $program->translate->terms_description : Input::old('terms_description_en'), ['class' => 'form-control', 'data-ckeditor'  ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_en', __('seo.seo_title')) }}
              {{ Form::text('seo_title_en',isset($program->translate('en')->first()->seo_title) ? $program->translate('en')->first()->seo_title  : Input::old('seo_title_en'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_en', __('admin.seo_description')) }}
              {{ Form::text('seo_description_en',isset($program->translate('en')->first()->seo_description) ? $program->translate('en')->first()->seo_description  : Input::old('seo_description_en'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ru">
          <div class="row">
            <div class="col-md-6 form-group">
              {{ Form::label('title_ru', __('admin.title')) }}
              {{ Form::text('title_ru',isset($program->translate->title) ? $program->translate->title  : Input::old('title_ru'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_ru', __('admin.description')) }}
              {{ Form::textarea('description_ru',isset($program->translate->description) ? $program->translate->description : Input::old('description_ru'), ['class' => 'form-control', 'data-ckeditor'  ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('terms_description_ru', __('admin.terms')) }}
              {{ Form::textarea('terms_description_ru',isset($program->translate->terms_description) ? $program->translate->terms_description : Input::old('terms_description_ru'), ['class' => 'form-control', 'data-ckeditor'  ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_ru', __('admin.seo_title')) }}
              {{ Form::text('seo_title_ru',isset($program->translate('ru')->first()->seo_title) ? $program->translate('ru')->first()->seo_title  : Input::old('seo_title_ru'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_ru', __('admin.seo_description')) }}
              {{ Form::text('seo_description_ru',isset($program->translate('ru')->first()->seo_description) ? $program->translate('ru')->first()->seo_description  : Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ua">
          <div class="row">
            <div class="col-md-6 form-group">
              {{ Form::label('title_ua', __('admin.title')) }}
              {{ Form::text('title_ua',isset($program->translate->title) ? $program->translate->title  : Input::old('title_ua'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_ua', __('admin.description')) }}
              {{ Form::textarea('description_ua',isset($program->translate->description) ? $program->translate->description : Input::old('description_ua'), ['class' => 'form-control', 'data-ckeditor'  ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('terms_description_ua', __('admin.terms')) }}
              {{ Form::textarea('terms_description_ua',isset($program->translate->terms_description) ? $program->translate->terms_description : Input::old('terms_description_ua'), ['class' => 'form-control', 'data-ckeditor'  ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_ua', __('admin.seo_title')) }}
              {{ Form::text('seo_title_ua',isset($program->translate('ua')->first()->seo_title) ? $program->translate('ua')->first()->seo_title  : Input::old('seo_title_ua'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_ua', __('admin.seo_description')) }}
              {{ Form::text('seo_description_ua',isset($program->translate('ua')->first()->seo_description) ? $program->translate('ua')->first()->seo_description  : Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group">
        <div class="file-load" data-file>
          <label class="file-load__label">
            {{Form::file('poster', ['class'=>'visually-hidden', 'data-file-input', 'accept'=>'image/*'])}}
            <span class="file-load__text">{{ __('admin.poster') }}</span>
          </label>

          <div class="file-load__list" data-file-list>
            @if($program->getFirstMediaUrl('posters', 'thumb'))
              <ul>
                <li>
                  <img src="{{$program->getFirstMediaUrl('posters', 'thumb')}}" alt="photo">
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

    {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}
    <a class="btn btn-warning " href="{{ route('programs.index') }}">{{ __('admin.cancel') }}</a>

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
    {!! Html::script('js/admin/global.js') !!}
    {!! Html::script('/vendor/unisharp/laravel-ckeditor/ckeditor.js') !!}
    {!! Html::script('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') !!}
    <script>
      $("[data-ckeditor]").ckeditor();
    </script>
@stop
