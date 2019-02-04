@extends('layouts.admin')
@section('content')
    <div class="df mb15">
      <h1 class="global__page-title">{{__('admin.editVacancy')}}</h1>
    </div>
    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($vacancy, array('route' => array('vacancies.update', $vacancy->id),'files'=>true, 'method' => 'PUT')) }}
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
                    {{ Form::label('title_en', __('vacancy.title')) }}
                    {{ Form::text('title_en',isset($vacancy->translate('en')->first()->title) ? $vacancy->translate('en')->first()->title  : Input::old('title_en'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-12 form-group">
                    {{ Form::label('description_en', __('vacancy.description')) }}
                    {{ Form::textarea('description_en',isset($vacancy->translate('en')->first()->description) ? $vacancy->translate('en')->first()->description  : Input::old('description_en'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-12 form-group">
                    {{ Form::label('add_description_en', __('vacancy.add_description')) }}
                    {{ Form::textarea('add_description_en',isset($vacancy->translate('en')->first()->add_description) ? $vacancy->translate('en')->first()->add_description  : Input::old('add_description_en'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_title_en', __('seo.seo_title')) }}
                  {{ Form::text('seo_title_en',isset($vacancy->translate('en')->first()->seo_title) ? $vacancy->translate('en')->first()->seo_title  : Input::old('seo_title_en'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_description_en', __('seo.seo_description')) }}
                  {{ Form::text('seo_description_en',isset($vacancy->translate('en')->first()->seo_description) ? $vacancy->translate('en')->first()->seo_description  : Input::old('seo_description_en'), ['class' => 'form-control' ]) }}
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="ru">
              <div class="row">
                <div class="col-md-6 form-group">
                    {{ Form::label('title_ru', __('vacancy.title')) }}
                    {{ Form::text('title_ru',isset($vacancy->translate('ru')->first()->title) ? $vacancy->translate('ru')->first()->title  : Input::old('title_ru'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-12 form-group">
                    {{ Form::label('description_ru', __('vacancy.description')) }}
                    {{ Form::textarea('description_ru',isset($vacancy->translate('ru')->first()->description) ? $vacancy->translate('ru')->first()->description  : Input::old('description_ru'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-12 form-group">
                    {{ Form::label('add_description_ru', __('vacancy.add_description')) }}
                    {{ Form::textarea('add_description_ru',isset($vacancy->translate('ru')->first()->add_description) ? $vacancy->translate('ru')->first()->add_description  : Input::old('add_description_ru'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_title_ru', __('seo.seo_title')) }}
                  {{ Form::text('seo_title_ru',isset($vacancy->translate('ru')->first()->seo_title) ? $vacancy->translate('ru')->first()->seo_title  : Input::old('seo_title_ru'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_description_ru', __('seo.seo_description')) }}
                  {{ Form::text('seo_description_ru',isset($vacancy->translate('ru')->first()->seo_description) ? $vacancy->translate('ru')->first()->seo_description  : Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="ua">
              <div class="row">
                <div class="col-md-6 form-group">
                    {{ Form::label('title_ua', __('vacancy.title')) }}
                    {{ Form::text('title_ua',isset($vacancy->translate('ua')->first()->title) ? $vacancy->translate('ua')->first()->title  : Input::old('title_ua'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-12 form-group">
                    {{ Form::label('description_ua', __('vacancy.description')) }}
                    {{ Form::textarea('description_ua',isset($vacancy->translate('ua')->first()->description) ? $vacancy->translate('ua')->first()->description  : Input::old('description_ua'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-12 form-group">
                    {{ Form::label('add_description_ua', __('vacancy.add_description')) }}
                    {{ Form::textarea('add_description_ua',isset($vacancy->translate('ua')->first()->add_description) ? $vacancy->translate('ua')->first()->add_description  : Input::old('add_description_ua'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_title_ua', __('seo.seo_title')) }}
                  {{ Form::text('seo_title_ua',isset($vacancy->translate('ua')->first()->seo_title) ? $vacancy->translate('ua')->first()->seo_title  : Input::old('seo_title_ua'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_description_ua', __('seo.seo_description')) }}
                  {{ Form::text('seo_description_ua',isset($vacancy->translate('ua')->first()->seo_description) ? $vacancy->translate('ua')->first()->seo_description  : Input::old('seo_description_ua'), ['class' => 'form-control' ]) }}
                </div>
              </div>
            </div>
        </div>

        <div class="form-group">
          <label class="global__checkbox">
            {{ Form::checkbox('is_active', 1, $vacancy->is_active ?? Input::old('is_active'),['id' => 'is_active']) }}
            <span class="global__checkbox-text">{{ __('vacancy.is_active') }}</span>
          </label>
        </div>
    </div>

    {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}
    <a class="btn btn-warning" href="{{ route('halls.index') }}">{{ __('admin.cancel') }}</a>

    {{ Form::close() }}
@endsection
@section('styles')
    {!! Html::style('css/select2.min.css') !!}
    {!! Html::style('css/admin.css') !!}
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
        CKEDITOR.replace( 'description_en' );
        CKEDITOR.replace( 'add_description_en' );
        CKEDITOR.replace( 'description_ru' );
        CKEDITOR.replace( 'add_description_ru' );
        CKEDITOR.replace( 'description_ua' );
        CKEDITOR.replace( 'add_description_ua' );
    </script>
@stop
