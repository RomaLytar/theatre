@extends('layouts.admin')
@section('content')
    <div class="df mb15">
      <h1 class="global__page-title">{{__('admin.editArticle')}}</h1>
    </div>

    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($article, array('route' => array('articles.update', $article->id),'files'=>true, 'method' => 'PUT')) }}
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
              {{ Form::label('title_en', __('article.title')) }}
              {{ Form::text('title_en',isset($article->translate->title) ? $article->translate->title  : Input::old('title_en'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('descriptions_en', __('article.descriptions')) }}
              {{ Form::textarea('descriptions_en', isset($article->translate->descriptions) ? $article->translate->descriptions : Input::old('descriptions_en'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_en', __('seo.seo_title')) }}
              {{ Form::text('seo_title_en',isset($article->translate('en')->first()->seo_title) ? $article->translate('en')->first()->seo_title  : Input::old('seo_title_en'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_en', __('seo.seo_description')) }}
              {{ Form::text('seo_description_en',isset($article->translate('en')->first()->seo_description) ? $article->translate('en')->first()->seo_description  : Input::old('seo_description_en'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ru">
          <div class="row">
            <div class="col-md-6 form-group">
              {{ Form::label('title_ru', __('article.title')) }}
              {{ Form::text('title_ru',isset($article->translate('ru')->first()->title) ? $article->translate('ru')->first()->title : Input::old('title_ru'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('descriptions_ru', __('article.descriptions')) }}
              {{ Form::textarea('descriptions_ru',isset($article->translate('ru')->first()->descriptions) ? $article->translate('ru')->first()->descriptions : Input::old('descriptions_ru'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_ru', __('seo.seo_title')) }}
              {{ Form::text('seo_title_ru',isset($article->translate('ru')->first()->seo_title) ? $article->translate('ru')->first()->seo_title  : Input::old('seo_title_ru'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_ru', __('seo.seo_description')) }}
              {{ Form::text('seo_description_ru',isset($article->translate('ru')->first()->seo_description) ? $article->translate('ru')->first()->seo_description  : Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="ua">
          <div class="row">
            <div class="col-md-6 form-group">
              {{ Form::label('title_ua', __('article.title')) }}
              {{ Form::text('title_ua',isset($article->translate('ua')->first()->title) ? $article->translate('ua')->first()->title : Input::old('title_ua'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::label('descriptions_ua', __('article.descriptions')) }}
              {{ Form::textarea('descriptions_ua',isset($article->translate('ua')->first()->descriptions) ? $article->translate('ua')->first()->descriptions : Input::old('descriptions_ua'), ['class' => 'form-control']) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_title_ua', __('seo.seo_title')) }}
              {{ Form::text('seo_title_ua',isset($article->translate('ua')->first()->seo_title) ? $article->translate('ua')->first()->seo_title  : Input::old('seo_title_ua'), ['class' => 'form-control' ]) }}
            </div>
            <div class="col-md-6 form-group">
              {{ Form::label('seo_description_ua', __('seo.seo_description')) }}
              {{ Form::text('seo_description_ua',isset($article->translate('ua')->first()->seo_description) ? $article->translate('ua')->first()->seo_description  : Input::old('seo_description_ua'), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group">
        {{ Form::label('category_id', __('article.category')) }}
        {{ Form::select('category_id', $articleCategories, Input::old('category_id'), ['class' => 'form-control']) }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::label('actors[]', __('article.actors')) }}
        {{ Form::select('actors[]', [], null, ['class' => 'form-control', 'data-selected' => json_encode($selectedActors)]) }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::label('performances[]', __('article.performances')) }}
        {{ Form::select('performances[]', [], null, ['class' => 'form-control', 'data-selected' => json_encode($selectedPerformances)]) }}
      </div>
    </div>

    <div class="panel panel-success">
      <div class="panel-heading">{{ __('admin.media') }}</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6 form-group">
            <div class="file-load" data-file>
              <label class="file-load__label">
                {{Form::file('poster', ['class'=>'visually-hidden', 'data-file-input', 'accept'=>'image/*'])}}
                <span class="file-load__text">{{ __('admin.photo') }}</span>
              </label>

              <div class="file-load__list" data-file-list>
                @if($article->getFirstMediaUrl('posters', 'thumb'))
                  <ul>
                    <li>
                      <img src="{{$article->getFirstMediaUrl('posters', 'thumb')}}" alt="photo">
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
          <div class="form-group col-md-12" id="video">
            {{ Form::label('videos', __('article.videos'))}}
            <input type="hidden" id="default-id" value="{{count($article->videos)-1}}">
            <div class="row" data-video-list>
              @if(count($article->videos)>0)
                @foreach($article->videos as $key=>$video)
                  <div class="form-group col-md-6 df fwn" id="div-{{$key}}">
                    <input class="form-control mr15" name="videos[{{$video->id}}]" id="input-{{$key}}" value="{{$video->url}}">
                    <a class="btn btn-danger" data-video-remove>
                      <i class="fa fa-trash"></i>
                    </a>
                  </div>
                @endforeach
              @endif
            </div>
            <a class="btn btn-success" data-video-add>{{__('article.addNewField')}}</a>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">{{__('article.images')}}</div>
      <div class="panel-body">
        <div class="file-load" data-file>
          <label class="file-load__label">
            {{Form::file('images[]', ['class'=>'visually-hidden', 'data-file-input', 'multiple', 'accept'=>'image/*'])}}
          </label>

          <div class="file-load__list" data-file-list>
            <ul>
              @foreach($article->getMedia('article-images') as $image)
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
    <a class="btn btn-warning" href="{{ route('articles.index') }}">{{ __('admin.cancel') }}</a>

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
    <script>
      CKEDITOR.replace( 'descriptions_en' );
      CKEDITOR.replace( 'descriptions_ru' );
      CKEDITOR.replace( 'descriptions_ua' );
    </script>
    {!! Html::script('js/admin/global.js') !!}
@stop
