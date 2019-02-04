@extends('layouts.admin')
@section('content')
    <div class="df mb15">
      <h1 class="global__page-title">{{__('admin.create_faq')}}</h1>
    </div>

    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::open(['url' => '/admin/faqs', 'files' => true, 'id' => 'create-performance-type']) }}
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
              {{ Form::label('title_en', __('admin.question')) }}
              {{ Form::text('title_en', Input::old('title_en'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_en', __('admin.answer')) }}
              {{ Form::textarea('description_en',  Input::old('description_en'), ['class' => 'form-control', 'data-ckeditor' ]) }}
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
              {{ Form::label('title_ru', __('admin.question')) }}
              {{ Form::text('title_ru',Input::old('title_ru'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_ru', __('admin.answer')) }}
              {{ Form::textarea('description_ru',Input::old('description_ru'), ['class' => 'form-control', 'data-ckeditor' ]) }}
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
              {{ Form::label('title_ua', __('admin.question')) }}
              {{ Form::text('title_ua', Input::old('title_ua'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('description_ua', __('admin.answer')) }}
              {{ Form::textarea('description_ua', Input::old('description_ua'), ['class' => 'form-control', 'data-ckeditor' ]) }}
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

      <div class="row">
        <div class="col-md-6 form-group">
          {{ Form::label('category_id', __('admin.cat')) }}
          {{ Form::select('category_id', $faqCategories, Input::old('category_id'), ['class' => 'form-control']) }}
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
    {!! Html::script('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') !!}
    <script>
      $("[data-ckeditor]").ckeditor();
    </script>
@stop
