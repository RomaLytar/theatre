@extends('layouts.admin')
@section('content')
    <div class="df mb15">
      <h1 class="global__page-title">{{__('admin.edit_documentation')}}</h1>
    </div>

    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($documentation, array('route' => array('documentations.update', $documentation->id),'files'=>true, 'method' => 'PUT')) }}
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
                    {{ Form::text('title_en',isset($documentation->translate->title) ? $documentation->translate->title  : Input::old('title_en'), ['class' => 'form-control' ]) }}
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="ru">
              <div class="row">
                <div class="col-md-6 form-group">
                  {{ Form::label('title_ru', __('admin.title')) }}
                    {{ Form::text('title_ru',isset($documentation->translate('ru')->first()->title) ? $documentation->translate('ru')->first()->title : Input::old('title_ru'), ['class' => 'form-control']) }}
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="ua">
              <div class="row">
                <div class="col-md-6 form-group">
                  {{ Form::label('title_ua', __('admin.title')) }}
                    {{ Form::text('title_ua',isset($documentation->translate('ua')->first()->title) ? $documentation->translate('ua')->first()->title : Input::old('title_ua'), ['class' => 'form-control']) }}
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group">
        {{ Form::label('category_id', __('admin.cat')) }}
        {{ Form::select('category_id', $documentationCategories, Input::old('category_id'), ['class' => 'form-control']) }}
      </div>
      <div class="col-md-6 form-group">
        <div class="file-load" data-file>
          <label class="file-load__label">
            {{Form::file('file', ['class'=>'visually-hidden', 'data-file-input', 'accept'=>'application/pdf'])}}
            <span class="file-load__text">{{ __('admin.file') }}</span>
          </label>

          <div class="file-load__list" data-file-list>
            @if($documentation->file != '')
              <ul>
                <li>
                  <div>
                    <svg viewBox="0 0 60 60" width="60" height="60" xmlns="http://www.w3.org/2000/svg">
                      <path d="m42.5 22h-25c-0.552 0-1 0.447-1 1s0.448 1 1 1h25c0.552 0 1-0.447 1-1s-0.448-1-1-1z"/>
                      <path d="m17.5 16h10c0.552 0 1-0.447 1-1s-0.448-1-1-1h-10c-0.552 0-1 0.447-1 1s0.448 1 1 1z"/>
                      <path d="m42.5 30h-25c-0.552 0-1 0.447-1 1s0.448 1 1 1h25c0.552 0 1-0.447 1-1s-0.448-1-1-1z"/>
                      <path d="m42.5 38h-25c-0.552 0-1 0.447-1 1s0.448 1 1 1h25c0.552 0 1-0.447 1-1s-0.448-1-1-1z"/>
                      <path d="m42.5 46h-25c-0.552 0-1 0.447-1 1s0.448 1 1 1h25c0.552 0 1-0.447 1-1s-0.448-1-1-1z"/>
                      <path d="M38.914,0H6.5v60h47V14.586L38.914,0z M39.5,3.414L50.086,14H39.5V3.414z M8.5,58V2h29v14h14v42H8.5z"/>
                    </svg>
                  </div>
                  <button type="button" class="btn btn-danger" data-file-remove="true">
                    <span class="fa fa-trash"></span>
                  </button>
                </li>
              </ul>
            @endif
          </div>

          <button type="button" class="btn btn-success" data-file-btn>
            <span class="glyphicon glyphicon-download-alt"></span> {{ __('admin.add_file') }}
          </button>
        </div>
      </div>
    </div>

    {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}
    <a class="btn btn-warning" href="{{ route('documentations.index') }}">{{ __('admin.cancel') }}</a>

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
@stop
