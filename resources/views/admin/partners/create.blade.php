@extends('layouts.admin')
@section('content')
    <div class="df mb15">
      <h1 class="global__page-title">{{__('admin.createPartner')}}</h1>
    </div>

    {{ Html::ul($errors->all()) }}

    {{ Form::open(['url' => '/admin/partners', 'files'=>true, 'id' => 'create-partner']) }}
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#en" aria-controls="home" role="tab" data-toggle="tab">EN</a></li>
            <li role="presentation"><a href="#ru" aria-controls="profile" role="tab" data-toggle="tab">RU</a></li>
            <li role="presentation"><a href="#ua" aria-controls="messages" role="tab" data-toggle="tab">UA</a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="en">
                <div class="form-group">
                    {{ Form::label('title_en', __('partner.title')) }}
                    {{ Form::text('title_en', Input::old('title_en'), ['class' => 'form-control' ]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('descriptions_en', __('partner.descriptions')) }}
                    {{ Form::textarea('descriptions_en',  Input::old('descriptions_en'), ['class' => 'form-control']) }}
                </div>
                <div class="row">
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
                <div class="form-group">
                    {{ Form::label('title_ru', __('partner.title')) }}
                    {{ Form::text('title_ru',Input::old('title_ru'), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('descriptions_ru', __('partner.descriptions')) }}
                    {{ Form::textarea('descriptions_ru',Input::old('descriptions_ru'), ['class' => 'form-control']) }}
                </div>
                <div class="row">
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
                <div class="form-group">
                    {{ Form::label('title_ua', __('partner.title')) }}
                    {{ Form::text('title_ua', Input::old('title_ua'), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('descriptions_ua', __('partner.descriptions')) }}
                    {{ Form::textarea('descriptions_ua', Input::old('descriptions_ua'), ['class' => 'form-control']) }}
                </div>
                <div class="row">
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
            {{ Form::label('category_id', __('partner.category')) }}
            {{ Form::select('category_id', $partnerCategories, Input::old('category_id'), ['class' => 'form-control']) }}
          </div>
            <div class="col-md-6 form-group">
                {{ Form::label('url', __('admin.url')) }}
                {{ Form::text('url', Input::old('url'), ['class' => 'form-control']) }}
            </div>
          <div class="col-md-6 form-group">
            <div class="file-load" data-file>
              <label class="file-load__label">
                {{Form::file('poster', ['class'=>'visually-hidden', 'data-file-input', 'accept'=>'image/*'])}}
                <span class="file-load__text">{{ __('partner.poster') }}</span>
              </label>

              <div class="file-load__list" data-file-list></div>

              <button type="button" class="btn btn-success" data-file-btn>
                <span class="glyphicon glyphicon-download-alt"></span> {{ __('admin.add_img') }}
              </button>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="global__checkbox">
            {{ Form::checkbox('is_active', 1, true) }}
            <span class="global__checkbox-text">{{ __('partner.is_active') }}</span>
          </label>
            <label class="global__checkbox">
                {{ Form::checkbox('url_partner', 1, true) }}
                <span class="global__checkbox-text">{{ __('partner.url_partner') }}</span>
            </label>

          <label class="global__checkbox">
            {{ Form::checkbox('in_footer', 1, false) }}
            <span class="global__checkbox-text">{{ __('partner.in_footer') }}</span>
          </label>

          <label class="global__checkbox">
            {{ Form::checkbox('is_main', 1, false) }}
            <span class="global__checkbox-text">{{ __('partner.is_main') }}</span>
          </label>

          <label class="global__checkbox">
            {{ Form::checkbox('is_middle', 1, false) }}
            <span class="global__checkbox-text">{{ __('partner.is_middle') }}</span>
          </label>
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
  {!! Html::script('/vendor/unisharp/laravel-ckeditor/ckeditor.js') !!}
  <script>
    CKEDITOR.replace( 'descriptions_en' );
    CKEDITOR.replace( 'descriptions_ru' );
    CKEDITOR.replace( 'descriptions_ua' );
  </script>
  {!! Html::script('js/admin/global.js') !!}
@stop
