@extends('layouts.admin')
@section('content')
    <div class="df mb15">
      <h1 class="global__page-title">{{__('admin.create_new_faq')}}</h1>
    </div>

    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($faqCategory, ['route' => array('faqs-categories.update', $faqCategory->id), 'method' => 'PUT']) }}
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
                  {{ Form::text('title_en',isset($faqCategory->translate('en')->first()->title) ? $faqCategory->translate('en')->first()->title  : Input::old('title_en'), ['class' => 'form-control' ]) }}
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="ru">
              <div class="row">
                <div class="col-md-6 form-group">
                  {{ Form::label('title_ru', __('admin.title')) }}
                  {{ Form::text('title_ru',isset($faqCategory->translate('ru')->first()->title) ? $faqCategory->translate('ru')->first()->title  : Input::old('title_ru'), ['class' => 'form-control' ]) }}
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="ua">
              <div class="row">
                <div class="col-md-6 form-group">
                  {{ Form::label('title_ua', __('admin.title')) }}
                  {{ Form::text('title_ua',isset($faqCategory->translate('ua')->first()->title) ? $faqCategory->translate('ua')->first()->title  : Input::old('title_ua'), ['class' => 'form-control' ]) }}
                </div>
              </div>
            </div>
        </div>
    </div>

    {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}
    <a class="btn btn-warning " href="{{ route('faqs.index') }}">{{ __('admin.cancel') }}</a>

    {{ Form::close() }}
@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
    {!! Html::script('js/plugins/mask.min.js') !!}
    {!! Html::script('js/plugins/moment.min.js') !!}
@stop
