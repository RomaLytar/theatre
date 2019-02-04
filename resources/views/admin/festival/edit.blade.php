@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.editFestival')}}</h1>
  </div>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::model($festival, [
      'route' => ['festival.update', $festival->id],
      'method' => 'PUT', 'id' => 'edit-festival',
      'files' => true
     ])
  }}
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
            {{ Form::label('title_en', __('festival.title')) }}
            {{ Form::text('title_en', Input::old('title_en'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-12 form-group">
            {{ Form::label('descriptions', __('festival.descriptions')) }}
            {{ Form::textarea('descriptions_en', Input::old('descriptions_en'), ['class' => 'form-control', 'data-ckeditor']) }}
          </div>
          <div class="col-md-12 form-group">
            {{ Form::label('invited_stars_en', __('admin.invitedStars')) }}
            {{ Form::textarea('invited_stars_en', Input::old('invited_stars_en'), ['class' => 'form-control', 'data-ckeditor']) }}
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
            {{ Form::label('title_ru', __('festival.title')) }}
            {{ Form::text('title_ru', Input::old('title_ru'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-12 form-group">
            {{ Form::label('descriptions_ru', __('admin.descriptions')) }}
            {{ Form::textarea('descriptions_ru', Input::old('descriptions_ru'), ['class' => 'form-control', 'data-ckeditor']) }}
          </div>
          <div class="col-md-12 form-group">
            {{ Form::label('invited_stars_ru', __('festival.invitedStars')) }}
            {{ Form::textarea('invited_stars_ru', Input::old('invited_stars_ru'), ['class' => 'form-control', 'data-ckeditor']) }}
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
            {{ Form::label('title_ua', __('festival.title')) }}
            {{ Form::text('title_ua', Input::old('title_ua'), ['class' => 'form-control']) }}
          </div>
          <div class="col-md-12 form-group">
            {{ Form::label('descriptions_ua', __('festival.descriptions')) }}
            {{ Form::textarea('descriptions_ua', Input::old('descriptions_ua  '), ['class' => 'form-control', 'data-ckeditor']) }}
          </div>
          <div class="col-md-12 form-group">
            {{ Form::label('invited_stars_ua', __('admin.invitedStars')) }}
            {{ Form::textarea('invited_stars_ua', Input::old('invited_stars_ua  '), ['class' => 'form-control', 'data-ckeditor']) }}
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
  </div>
  <div class="row">
    <div class="col-md-6 form-group">
      {{ Form::label('fb_link', __('festival.fbLink')) }}
      {{ Form::text('fb_link', Input::old('fb_link'), ['class' => 'form-control']) }}
    </div>
    <div class="col-md-6 form-group">
      {{ Form::label('tw_link', __('festival.twLink')) }}
      {{ Form::text('tw_link', Input::old('tw_link'), ['class' => 'form-control']) }}
    </div>
    <div class="col-md-6 form-group">
      <div class="file-load" data-file>
        <label class="file-load__label">
          {{Form::file('poster', ['class'=>'visually-hidden', 'data-file-input', 'accept'=>'image/*'])}}
          <span class="file-load__text">{{ __('performance.poster') }}</span>
        </label>

        <div class="file-load__list" data-file-list>
          @if($festival->getFirstMediaUrl('posters', 'thumb'))
            <ul>
              <li>
                <img src="{{$festival->getFirstMediaUrl('posters', 'thumb')}}" alt="photo">
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

  <div class="panel panel-info">
    <div class="panel-heading">{{__('admin.performances')}}</div>
    <div class="panel-body">
      <div class="form-group">
        <input type="search" name="q" class="form-control search-input" placeholder={{ __('admin.search') }} autocomplete="off">
      </div>
      <div class="performances df row jcst">
        @foreach($festival->calendars as $date)
          <div class="w33">
            <input type="hidden" name="performances[]" value="{{ $date->id }}"/>
            <div class="row performance" data-id="{{ $date->id }}">
              <div class="col-md-4">
                <img class="img-thumbnail" src="{{ $date->performance->poster }}"/>
              </div>
              <div class="col-md-8">
                <p><strong>{{ $date->performance->translate->title }}</strong></p>
                <p>{{ $date->date }}</p>
                <a class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="panel panel-success">
    <div class="panel-heading">{{__('admin.videos')}}</div>
    <div class="panel-body">
      <div class="row">
        <div class="form-group col-md-12" id="video">
          {{ Form::label('videos', __('festival.videos'))}}
          <input type="hidden" id="default-id" value="{{count($festival->videos)-1}}">
          <div class="row" data-video-list>
            @foreach($festival->videos as $key=>$video)
              <div class="form-group col-md-6 df fwn" id="div-{{$key}}">
                <input class="form-control mr15" name="videos[{{$video->id}}]" id="input-{{$key}}" value="{{$video->url}}">
                <a class="btn btn-danger" data-video-remove>
                  <i class="fa fa-trash"></i>
                </a>
              </div>
            @endforeach
          </div>
          <a class="btn btn-success" data-video-add>{{__('performance.addVideoLink')}}</a>
        </div>
      </div>
    </div>
  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">{{__('admin.photo')}}</div>
    <div class="panel-body">
      <div class="file-load" data-file>
        <label class="file-load__label">
          {{Form::file('images[]', ['class'=>'visually-hidden', 'data-file-input', 'multiple', 'accept'=>'image/*'])}}
        </label>

        <div class="file-load__list" data-file-list>
          <ul>
            @foreach($festival->getMedia('album-images') as $image)
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
  <a class="btn btn-warning" href="{{ route('festival.index') }}">{{ __('admin.cancel') }}</a>

  {{ Form::close() }}
@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
  {!! Html::script('js/plugins/typeahead.bundle.min.js') !!}
  <script>
    $(document).ready(function() {
      let engine = new Bloodhound({
        remote: {
          url: '/admin/search/performance?q=%QUERY%',
          wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
      });
      $(".search-input").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      }, {
        source: engine.ttAdapter(),

        // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
        name: 'performanceList',

        // the key from the array we want to display (name,id,email,etc...)
        templates: {
          empty: [
            '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
          ],
          header: [
            '<div class="list-group search-results-dropdown">'
          ],
          suggestion: function (data) {
            return '<a href="#" class="list-group-item">' + data.title + '  - @' + data.date + '</a>'
          }
        },
        display: ''
      }).bind('typeahead:selected', function(obj, selected, name) {
        const performancesBlock = $('.performances');

        $(".search-input").typeahead('val', '');
        const performance = `<div class="row performance" data-id="${selected.idDate}">` +
          `<div class="col-md-4"><img class="img-thumbnail" src="${selected.poster}"/></div>` +
          `<div class="col-md-8"><p><strong>${selected.title}</strong> <a class="pull-right btn btn-danger delete">Delete</a></p>`+
          `<p>${selected.date}</p></div>` +
          `</div>`;

        const input = `<input type="hidden" name="performances[]" value="${selected.idDate}"/>`
        $('#edit-festival').append(input)
        performancesBlock.append(performance);
        return false;
      }).off('blur');

      $(document).on('click', '.delete', function () {
        const id = $(this).closest('.performance').attr('data-id');
        $(`input[data-id="${id}"][name="performances[]"]`).remove();
        $(this).closest('.performance').remove();
      })
    });
  </script>
  {!! Html::script('/vendor/unisharp/laravel-ckeditor/ckeditor.js') !!}
  {!! Html::script('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') !!}
  <script>
    $("[data-ckeditor]").ckeditor();
  </script>
  {!! Html::script('js/admin/global.js') !!}
@stop
