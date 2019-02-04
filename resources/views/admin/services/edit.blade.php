@extends('layouts.admin')
@section('content')
    <div class="df mb15">
      <h1 class="global__page-title">{{__('admin.editService')}}</h1>
    </div>

    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($service, array('route' => array('services.update', $service->id),'files'=>true, 'method' => 'PUT')) }}
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
              {{ Form::label('title_en', __('service.title')) }}
              {{ Form::text('title_en',isset($service->translate->title) ? $service->translate->title  : Input::old('title_en'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_en', __('service.description')) }}
              {{ Form::textarea('description_en',isset($service->translate->description) ? $service->translate->description  : Input::old('description_en'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_en', __('seo.seo_title')) }}
              {{ Form::text('seo_title_en',isset($service->translate('en')->first()->seo_title) ? $service->translate('en')->first()->seo_title  : Input::old('seo_title_en'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_en', __('seo.seo_description')) }}
              {{ Form::text('seo_description_en',isset($service->translate('en')->first()->seo_description) ? $service->translate('en')->first()->seo_description  : Input::old('seo_description_en'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ru">
          <div class="row">
            <div class="col-md-6 form-group">
              {{ Form::label('title_ru', __('service.title')) }}
              {{ Form::text('title_ru',isset($service->translate->title) ? $service->translate->title  : Input::old('title_ru'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_ru', __('service.description')) }}
              {{ Form::text('description_ru',isset($service->translate->description) ? $service->translate->description  : Input::old('description_ru'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_ru', __('seo.seo_title')) }}
              {{ Form::text('seo_title_ru',isset($service->translate('ru')->first()->seo_title) ? $service->translate('ru')->first()->seo_title  : Input::old('seo_title_ru'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_ru', __('seo.seo_description')) }}
              {{ Form::text('seo_description_ru',isset($service->translate('ru')->first()->seo_description) ? $service->translate('ru')->first()->seo_description  : Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ua">
          <div class="row">
            <div class="col-md-6 form-group">
              {{ Form::label('title_ua', __('service.title')) }}
              {{ Form::text('title_ua',isset($service->translate->title) ? $service->translate->title  : Input::old('title_ua'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_ua', __('service.description')) }}
              {{ Form::text('description_ua',isset($service->translate->description) ? $service->translate->description  : Input::old('description_ua'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_ua', __('seo.seo_title')) }}
              {{ Form::text('seo_title_ua',isset($service->translate('ua')->first()->seo_title) ? $service->translate('ua')->first()->seo_title  : Input::old('seo_title_ua'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_ua', __('seo.seo_description')) }}
              {{ Form::text('seo_description_ua',isset($service->translate('ua')->first()->seo_description) ? $service->translate('ua')->first()->seo_description  : Input::old('seo_description_ua'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">{{__('admin.gallery')}}</div>
      <div class="panel-body">
        <div class="file-load" data-file>
          <label class="file-load__label">
            {{Form::file('images[]', ['class'=>'visually-hidden', 'data-file-input', 'multiple', 'accept'=>'image/*'])}}
          </label>

          <div class="file-load__list" data-file-list>
            <ul>
              @foreach($service->getMedia('service-images') as $image)
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
    <a class="btn btn-warning " href="{{ route('services.index') }}">{{ __('admin.cancel')  }}</a>

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
    <script>
        CKEDITOR.replace( 'description_en' );
        CKEDITOR.replace( 'description_ru' );
        CKEDITOR.replace( 'description_ua' );
    </script>
@stop
