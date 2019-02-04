@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.editActor')}}</h1>
  </div>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::model($actor, array('route' => array('actor.update', $actor->id),'files'=>true, 'method' => 'PUT')) }}
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
            {{ Form::text('firstName_en',isset($actor->translate->firstName) ? $actor->translate->firstName  : Input::old('firstName_en'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('lastName_en', __('actor.lastName')) }}
            {{ Form::text('lastName_en', isset($actor->translate->lastName) ? $actor->translate->lastName : Input::old('lastName_en'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('patronymic_en', __('admin.patronymic')) }}
            {{ Form::text('patronymic_en', isset($actor->translate->patronymic) ? $actor->translate->patronymic : Input::old('patronymic_en'), ['class' => 'form-control']) }}
          </div>
          <div class="col-xs-12 form-group">
            {{ Form::label('descriptions_en', __('actor.descriptions')) }}
            {{ Form::textarea('descriptions_en', isset($actor->translate->descriptions) ? $actor->translate->descriptions : Input::old('descriptions_en'), ['class' => 'form-control', 'data-ckeditor']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('position_en', __('actor.position')) }}
            {{ Form::text('position_en', $actor->translate('en')->first()->position ?? Input::old('position_en'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('degree_en', __('actor.degree')) }}
            {{ Form::text('degree_en',isset($actor->translate->degree) ? $actor->translate->degree : Input::old('degree_en'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('debut_en', __('actor.debut')) }}
            {{ Form::text('debut_en',isset($actor->translate->debut) ? $actor->translate->debut : Input::old('debut_en'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('repertoire_en', __('actor.repertoire')) }}
            {{ Form::text('repertoire_en',isset($actor->translate->repertoire) ? $actor->translate->repertoire : Input::old('repertoire_en'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('merit_en', __('actor.merit')) }}
            {{ Form::text('merit_en',isset($actor->translate->merit) ? $actor->translate->merit : Input::old('merit_en'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('hometown_en', __('actor.hometown')) }}
            {{ Form::text('hometown_en',isset($actor->translate->hometown) ? $actor->translate->hometown : Input::old('hometown_en'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_en', __('seo.seo_title')) }}
            {{ Form::text('seo_title_en',isset($actor->translate('en')->first()->seo_title) ? $actor->translate('en')->first()->seo_title  : Input::old('seo_title_en'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_en', __('seo.seo_description')) }}
            {{ Form::text('seo_description_en',isset($actor->translate('en')->first()->seo_description) ? $actor->translate('en')->first()->seo_description  : Input::old('seo_description_en'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ru">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('firstName_ru', __('actor.firstName')) }}
            {{ Form::text('firstName_ru',isset($actor->translate('ru')->first()->firstName) ? $actor->translate('ru')->first()->firstName : Input::old('firstName_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('lastName_ru', __('actor.lastName')) }}
            {{ Form::text('lastName_ru',isset($actor->translate('ru')->first()->lastName) ? $actor->translate('ru')->first()->lastName : Input::old('lastName_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('patronymic_ru', __('admin.patronymic')) }}
            {{ Form::text('patronymic_ru',isset($actor->translate('ru')->first()->patronymic) ? $actor->translate('ru')->first()->patronymic : Input::old('patronymic_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-xs-12 form-group">
            {{ Form::label('descriptions_ru', __('actor.descriptions')) }}
            {{ Form::textarea('descriptions_ru',isset($actor->translate('ru')->first()->descriptions) ? $actor->translate('ru')->first()->descriptions : Input::old('descriptions_ru'), ['class' => 'form-control', 'data-ckeditor']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('position_ru', __('actor.position')) }}
            {{ Form::text('position_ru', $actor->translate('ru')->first()->position ?? Input::old('position_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('degree_ru', __('actor.degree')) }}
            {{ Form::text('degree_ru',isset($actor->translate('ru')->first()->degree)? $actor->translate('ru')->first()->degree : Input::old('degree_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('debut_ru', __('actor.debut')) }}
            {{ Form::text('debut_ru',isset($actor->translate('ru')->first()->debut) ? $actor->translate('ru')->first()->debut : Input::old('debut_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('repertoire_ru', __('actor.repertoire')) }}
            {{ Form::text('repertoire_ru',isset($actor->translate('ru')->first()->repertoire) ? $actor->translate('ru')->first()->repertoire : Input::old('repertoire_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('merit_ru', __('actor.merit')) }}
            {{ Form::text('merit_ru',isset($actor->translate('ru')->first()->merit) ? $actor->translate('ru')->first()->merit : Input::old('merit_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('hometown_ru', __('actor.hometown')) }}
            {{ Form::text('hometown_ru', isset($actor->translate('ru')->first()->hometown) ? $actor->translate('ru')->first()->hometown : Input::old('hometown_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ru', __('seo.seo_title')) }}
            {{ Form::text('seo_title_ru',isset($actor->translate('ru')->first()->seo_title) ? $actor->translate('ru')->first()->seo_title  : Input::old('seo_title_ru'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ru', __('seo.seo_description')) }}
            {{ Form::text('seo_description_ru',isset($actor->translate('ru')->first()->seo_description) ? $actor->translate('ru')->first()->seo_description  : Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ua">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('firstName_ua', __('actor.firstName')) }}
            {{ Form::text('firstName_ua',isset($actor->translate('ua')->first()->firstName) ? $actor->translate('ua')->first()->firstName : Input::old('firstName_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('lastName_ua', __('actor.lastName')) }}
            {{ Form::text('lastName_ua',isset($actor->translate('ua')->first()->lastName) ? $actor->translate('ua')->first()->lastName : Input::old('lastName_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('patronymic_ua', __('admin.patronymic')) }}
            {{ Form::text('patronymic_ua',isset($actor->translate('ua')->first()->patronymic) ? $actor->translate('ua')->first()->patronymic : Input::old('patronymic_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-xs-12 form-group">
            {{ Form::label('descriptions_ua', __('actor.descriptions')) }}
            {{ Form::textarea('descriptions_ua',isset($actor->translate('ua')->first()->descriptions) ? $actor->translate('ua')->first()->descriptions : Input::old('descriptions_ua'), ['class' => 'form-control', 'data-ckeditor']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('position_ua', __('actor.position')) }}
            {{ Form::text('position_ua', $actor->translate('ua')->first()->position ?? Input::old('position_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('degree_ua', __('actor.degree')) }}
            {{ Form::text('degree_ua',isset($actor->translate('ua')->first()->degree) ? $actor->translate('ua')->first()->degree : Input::old('degree_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('debut_ua', __('actor.debut')) }}
            {{ Form::text('debut_ua',isset($actor->translate('ua')->first()->debut) ? $actor->translate('ua')->first()->debut : Input::old('debut_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('repertoire_ua', __('actor.repertoire')) }}
            {{ Form::text('repertoire_ua',isset($actor->translate('ua')->first()->repertoire)? $actor->translate('ua')->first()->repertoire : Input::old('repertoire_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('merit_ua', __('actor.merit')) }}
            {{ Form::text('merit_ua',isset($actor->translate('ua')->first()->merit) ? $actor->translate('ua')->first()->merit : Input::old('merit_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('hometown_ua', __('actor.hometown')) }}
            {{ Form::text('hometown_ua',isset($actor->translate('ua')->first()->hometown) ? $actor->translate('ua')->first()->hometown :  Input::old('hometown_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_title_ua', __('seo.seo_title')) }}
            {{ Form::text('seo_title_ua',isset($actor->translate('ua')->first()->seo_title) ? $actor->translate('ua')->first()->seo_title  : Input::old('seo_title_ua'), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-6 form-group">
            {{ Form::label('seo_description_ua', __('seo.seo_description')) }}
            {{ Form::text('seo_description_ua',isset($actor->translate('ua')->first()->seo_description) ? $actor->translate('ua')->first()->seo_description  : Input::old('seo_description_ua'), ['class' => 'form-control' ]) }}
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
        {{ Form::text('dob', $actor->dob, ['class' => 'form-control', 'id' =>'dob_date']) }}
      </div>
    </div>
    <div class="col-md-12 form-group">
      <label class="global__checkbox">
        {{ Form::checkbox('is_main', 1, $actor->is_main ?? Input::old('is_main')) }}
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

            <div class="file-load__list" data-file-list>
              @if($actor->getFirstMediaUrl('posters', 'thumb'))
                <ul>
                  <li>
                    <img src="{{$actor->getFirstMediaUrl('posters', 'thumb')}}" alt="photo">
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
    </div>
  </div>
  <div class="panel panel-primary">
    <div class="panel-heading">{{ __('admin.social_links') }}</div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-6 form-group">
          {{ Form::label('facebook', __('actor.facebook')) }}
          {{ Form::text('facebook', $actor->facebook, ['class' => 'form-control']) }}
        </div>
        <div class="col-md-6 form-group">
          {{ Form::label('twitter', __('actor.twitter')) }}
          {{ Form::text('twitter', $actor->twitter, ['class' => 'form-control']) }}
        </div>
        <div class="col-md-6 form-group">
          {{ Form::label('youtube', __('actor.youtube')) }}
          {{ Form::text('youtube', $actor->youtube, ['class' => 'form-control']) }}
        </div>
        <div class="col-md-6 form-group">
          {{ Form::label('instagram', __('actor.instagram')) }}
          {{ Form::text('instagram', $actor->instagram, ['class' => 'form-control']) }}
        </div>
      </div>
    </div>
  </div>
  {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}
  <a class="btn btn-warning " href="{{ URL::to('admin/actor/') }}">{{ __('admin.cancel') }}</a>

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

