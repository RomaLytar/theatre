@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.createActor')}}</h1>
  </div>

    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::open(['url' => '/admin/actor', 'files'=>true, 'id' => 'create-actor']) }}
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
                  {{ Form::label('firstName_en', __('actor.firstName')) }}
                  {{ Form::text('firstName_en', Input::old('firstName_en'), ['class' => 'form-control' ]) }}
              </div>
              <div class="col-md-6 form-group">
                {{ Form::label('lastName_en', __('actor.lastName')) }}
                {{ Form::text('lastName_en', Input::old('lastName_en'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                {{ Form::label('patronymic_en', __('admin.patronymic')) }}
                {{ Form::text('patronymic_en', Input::old('patronymic_en'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-12 form-group">
                  {{ Form::label('descriptions_en', __('admin.description')) }}
                  {{ Form::textarea('descriptions_en',  Input::old('descriptions_en'), ['class' => 'form-control', 'data-ckeditor']) }}
              </div>
              <div class="col-md-6 form-group">
                {{ Form::label('position_en', __('actor.position')) }}
                {{ Form::text('position_en', Input::old('position_en'), ['class' => 'form-control' ]) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('degree_en', __('actor.degree')) }}
                  {{ Form::text('degree_en',Input::old('degree_en'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('debut_en', __('actor.debut')) }}
                  {{ Form::text('debut_en', Input::old('debut_en'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('repertoire_en', __('actor.repertoire')) }}
                  {{ Form::text('repertoire_en', Input::old('repertoire_en'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('merit_en', __('actor.merit')) }}
                  {{ Form::text('merit_en',Input::old('merit_en'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('hometown_en', __('actor.hometown')) }}
                  {{ Form::text('hometown_en',Input::old('hometown_en'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                {{ Form::label('seo_title_en', __('admin.seo_title')) }}
                {{ Form::text('seo_title_en', Input::old('seo_title_en'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                {{ Form::label('seo_description_en', __('admin.seo_description')) }}
                {{ Form::text('seo_description_en', Input::old('seo_description_en'), ['class' => 'form-control']) }}
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="ru">
            <div class="row">
              <div class="col-md-6 form-group">
                  {{ Form::label('firstName_ru', __('actor.firstName')) }}
                  {{ Form::text('firstName_ru',Input::old('firstName_ru'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('lastName_ru', __('actor.lastName')) }}
                  {{ Form::text('lastName_ru', Input::old('lastName_ru'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                {{ Form::label('patronymic_ru', __('admin.patronymic')) }}
                {{ Form::text('patronymic_ru', Input::old('patronymic_ru'), ['class' => 'form-control']) }}
              </div>
              <div class="col-xs-12 form-group">
                  {{ Form::label('descriptions_ru', __('admin.description')) }}
                  {{ Form::textarea('descriptions_ru',Input::old('descriptions_ru'), ['class' => 'form-control', 'data-ckeditor']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('position_ru', __('actor.position')) }}
                  {{ Form::text('position_ru', Input::old('position_ru'), ['class' => 'form-control' ]) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('degree_ru', __('actor.degree')) }}
                  {{ Form::text('degree_ru', Input::old('degree_ru'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('debut_ru', __('actor.debut')) }}
                  {{ Form::text('debut_ru', Input::old('debut_ru'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('repertoire_ru', __('actor.repertoire')) }}
                  {{ Form::text('repertoire_ru', Input::old('repertoire_ru'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('merit_ru', __('actor.merit')) }}
                  {{ Form::text('merit_ru', Input::old('merit_ru'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('hometown_ru', __('actor.hometown')) }}
                  {{ Form::text('hometown_ru', Input::old('hometown_ru'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                {{ Form::label('seo_title_ru', __('admin.seo_title')) }}
                {{ Form::text('seo_title_ru', Input::old('seo_title_ru'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                {{ Form::label('seo_description_ru', __('admin.seo_description')) }}
                {{ Form::text('seo_description_ru', Input::old('seo_description_ru'), ['class' => 'form-control']) }}
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="ua">
            <div class="row">
              <div class="col-md-6 form-group">
                  {{ Form::label('firstName_ua', __('actor.firstName')) }}
                  {{ Form::text('firstName_ua', Input::old('firstName_ua'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('lastName_ua', __('actor.lastName')) }}
                  {{ Form::text('lastName_ua', Input::old('lastName_ua'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                {{ Form::label('patronymic_ua', __('admin.patronymic')) }}
                {{ Form::text('patronymic_ua', Input::old('patronymic_ua'), ['class' => 'form-control']) }}
              </div>
              <div class="col-xs-12 form-group">
                  {{ Form::label('descriptions_ua', __('admin.description')) }}
                  {{ Form::textarea('descriptions_ua', Input::old('descriptions_ua'), ['class' => 'form-control', 'data-ckeditor']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('position_ua', __('actor.position')) }}
                  {{ Form::text('position_ua', Input::old('position_ua'), ['class' => 'form-control' ]) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('degree_ua', __('actor.degree')) }}
                  {{ Form::text('degree_ua', Input::old('degree_ua'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('debut_ua', __('actor.debut')) }}
                  {{ Form::text('debut_ua',Input::old('debut_ua'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('repertoire_ua', __('actor.repertoire')) }}
                  {{ Form::text('repertoire_ua', Input::old('repertoire_ua'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('merit_ua', __('actor.merit')) }}
                  {{ Form::text('merit_ua', Input::old('merit_ua'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                  {{ Form::label('hometown_ua', __('actor.hometown')) }}
                  {{ Form::text('hometown_ua', Input::old('hometown_ua'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                {{ Form::label('seo_title_ua', __('admin.seo_title')) }}
                {{ Form::text('seo_title_ua', Input::old('seo_title_ua'), ['class' => 'form-control']) }}
              </div>
              <div class="col-md-6 form-group">
                {{ Form::label('seo_description_ua', __('admin.seo_description')) }}
                {{ Form::text('seo_description_ua', Input::old('seo_description_ua'), ['class' => 'form-control']) }}
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group">
          {{ Form::label('group_id', __('actor.group')) }}
          {{ Form::select('group_id', $actorGroups, Input::old('group_id'), ['class' => 'form-control']) }}
      </div>
      <div class="col-md-6 performance-date form-group">
        {{ Form::label('dob', __('actor.dob')) }}
        <div class='input-group date' id='datetimepicker1'>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
          {{ Form::text('dob', null, ['class' => 'form-control']) }}
        </div>
      </div>
      <div class="col-md-12 form-group">
        <label class="global__checkbox">
          {{ Form::checkbox('is_main', 1, true) }}
          <span class="global__checkbox-text">{{ __('actor.is_main') }}</span>
        </label>
      </div>
    </div>
    <div class="panel panel-success">
      <div class="panel-heading">{{ __('admin.media') }}</div>
      <div class="panel-body">
        <div class="row">
          <div class="form-group col-md-12">
            <div class="file-load" data-file>
              <label class="file-load__label">
                {{Form::file('poster', ['class'=>'visually-hidden', 'data-file-input', 'accept'=>'image/*'])}}
                <span class="file-load__text">{{ __('admin.poster') }}</span>
              </label>

              <div class="file-load__list" data-file-list></div>

              <button type="button" class="btn btn-success" data-file-btn>
                <span class="glyphicon glyphicon-download-alt"></span> {{ __('admin.add_img') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-primary">
      <div class="panel-heading">{{ __('admin.social_links') }}</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('facebook', __('actor.facebook')) }}
            {{ Form::text('facebook', Input::old('facebook'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
              {{ Form::label('twitter', __('actor.twitter')) }}
              {{ Form::text('twitter', Input::old('twitter'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
              {{ Form::label('youtube', __('actor.youtube')) }}
              {{ Form::text('youtube', Input::old('youtube'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
              {{ Form::label('instagram', __('actor.instagram')) }}
              {{ Form::text('instagram', Input::old('instagram'), ['class' => 'form-control']) }}
          </div>
        </div>
      </div>
    </div>

    {{ Form::submit(__('admin.create'), ['class' => 'btn btn-success']) }}

    {{ Form::close() }}
@endsection
@section('styles')
    {!! Html::style('css/select2.min.css') !!}
    {!! Html::style('css/bootstrap-datetimepicker.css') !!}
    {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
    {!! Html::script('js/plugins/mask.min.js') !!}
    {!! Html::script('js/plugins/moment.min.js') !!}
    {!! Html::script('js/plugins/select2.min.js') !!}
    {!! Html::script('js/plugins/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('js/admin/actor.js') !!}
    {!! Html::script('/vendor/unisharp/laravel-ckeditor/ckeditor.js') !!}
    {!! Html::script('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') !!}
    <script>
      $("[data-ckeditor]").ckeditor();
    </script>
    {!! Html::script('js/admin/global.js') !!}
@stop
