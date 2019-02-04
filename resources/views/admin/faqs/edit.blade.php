@extends('layouts.admin')
@section('content')
    <div class="df mb15">
      <h1 class="global__page-title">{{__('admin.edit_faq')}}</h1>
    </div>

    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($faq, array('route' => array('faqs.update', $faq->id),'files'=>true, 'method' => 'PUT')) }}
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
              {{ Form::text('title_en',isset($faq->translate->title) ? $faq->translate->title  : Input::old('title_en'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_en', __('admin.description')) }}
              {{ Form::textarea('description_en', isset($faq->translate->description) ? $faq->translate->description : Input::old('descriptions_en'), ['class' => 'form-control', 'data-ckeditor' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_en', __('admin.seo_title')) }}
              {{ Form::text('seo_title_en',isset($faq->translate('en')->first()->seo_title) ? $faq->translate('en')->first()->seo_title  : Input::old('seo_title_en'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_en', __('admin.seo_description')) }}
              {{ Form::text('seo_description_en',isset($faq->translate('en')->first()->seo_description) ? $faq->translate('en')->first()->seo_description  : Input::old('seo_description_en'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ru">
          <div class="row">
            <div class="col-md-6 form-group">
              {{ Form::label('title_ru', __('admin.title')) }}
              {{ Form::text('title_ru',isset($faq->translate('ru')->first()->title) ? $faq->translate('ru')->first()->title : Input::old('title_ru'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_ru', __('admin.description')) }}
              {{ Form::textarea('description_ru',isset($faq->translate('ru')->first()->description) ? $faq->translate('ru')->first()->description : Input::old('descriptions_ru'), ['class' => 'form-control', 'data-ckeditor' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_ru', __('admin.seo_title')) }}
              {{ Form::text('seo_title_ru',isset($faq->translate('ru')->first()->seo_title) ? $faq->translate('ru')->first()->seo_title  : Input::old('seo_title_ru'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_ru', __('admin.seo_description')) }}
              {{ Form::text('seo_description_ru',isset($faq->translate('ru')->first()->seo_description) ? $faq->translate('ru')->first()->seo_description  : Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ua">
          <div class="row">
            <div class="col-md-6 form-group">
              {{ Form::label('title_ua', __('admin.title')) }}
              {{ Form::text('title_ua',isset($faq->translate('ua')->first()->title) ? $faq->translate('ua')->first()->title : Input::old('title_ua'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_ua', __('admin.description')) }}
              {{ Form::textarea('description_ua',isset($faq->translate('ua')->first()->description) ? $faq->translate('ua')->first()->description : Input::old('descriptions_ua'), ['class' => 'form-control', 'data-ckeditor' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_ua', __('admin.seo_title')) }}
              {{ Form::text('seo_title_ua',isset($faq->translate('ua')->first()->seo_title) ? $faq->translate('ua')->first()->seo_title  : Input::old('seo_title_ua'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_ua', __('admin.seo_description')) }}
              {{ Form::text('seo_description_ua',isset($faq->translate('ua')->first()->seo_description) ? $faq->translate('ua')->first()->seo_description  : Input::old('seo_description_ua'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group">
        {{ Form::label('category_id', __('admin.cat')) }}
        {{ Form::select('category_id', $faqCategories, Input::old('category_id'), ['class' => 'form-control']) }}
      </div>
    </div>

    {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}
    <a class="btn btn-warning " href="{{ route('faqs.index') }}">{{ __('admin.cancel') }}</a>
@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
    {!! Html::script('js/plugins/mask.min.js') !!}
    {!! Html::script('js/plugins/moment.min.js') !!}
    {!! Html::script('/vendor/unisharp/laravel-ckeditor/ckeditor.js') !!}
    {!! Html::script('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') !!}
    <script>
      $("[data-ckeditor]").ckeditor();
    </script>
@stop
