@extends('layouts.admin')
@section('content')
    <div class="df mb15">
      <h1 class="global__page-title">{{__('admin.editPage')}}</h1>
    </div>

    {{ Html::ul($errors->all()) }}

    {{ Form::model($page, array('route' => array('pages.update', $page->id),'files'=>true, 'method' => 'PUT')) }}
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
                  {{ Form::label('title_en', __('page.title')) }}
                  {{ Form::text('title_en', $page->translate('en')->first()->title ?? Input::old('title_en'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-12 form-group">
                  {{ Form::label('descriptions_en', __('page.descriptions')) }}
                  {{ Form::textarea('descriptions_en', $page->translate->descriptions ?? Input::old('descriptions_en'), ['class' => 'form-control', 'data-ckeditor']) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_title_en', __('seo.seo_title')) }}
                  {{ Form::text('seo_title_en', $page->translate('en')->first()->seo_title ?? Input::old('seo_title_en'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_description_en', __('seo.seo_description')) }}
                  {{ Form::text('seo_description_en', $page->translate('en')->first()->seo_description ?? Input::old('seo_description_en'), ['class' => 'form-control' ]) }}
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="ru">
              <div class="row">
                <div class="col-md-6 form-group">
                  {{ Form::label('title_ru', __('page.title')) }}
                  {{ Form::text('title_ru', $page->translate('ru')->first()->title ?? Input::old('title_ru'), ['class' => 'form-control']) }}
                </div>
                <div class="col-md-12 form-group">
                  {{ Form::label('descriptions_ru', __('page.descriptions')) }}
                  {{ Form::textarea('descriptions_ru', $page->translate('ru')->first()->descriptions ?? Input::old('descriptions_ru'), ['class' => 'form-control', 'data-ckeditor']) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_title_ru', __('seo.seo_title')) }}
                  {{ Form::text('seo_title_ru', $page->translate('ru')->first()->seo_title ?? Input::old('seo_title_ru'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_description_ru', __('seo.seo_description')) }}
                  {{ Form::text('seo_description_ru', $page->translate('ru')->first()->seo_description ?? Input::old('seo_description_ru'), ['class' => 'form-control' ]) }}
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="ua">
              <div class="row">
                <div class="col-md-6 form-group">
                  {{ Form::label('title_ua', __('page.title')) }}
                  {{ Form::text('title_ua', $page->translate('ua')->first()->title ?? Input::old('title_ua'), ['class' => 'form-control']) }}
                </div>
                <div class="col-md-12 form-group">
                  {{ Form::label('descriptions_ua', __('page.descriptions')) }}
                  {{ Form::textarea('descriptions_ua', $page->translate('ua')->first()->descriptions ?? Input::old('descriptions_ua'), ['class' => 'form-control', 'data-ckeditor']) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_title_ua', __('seo.seo_title')) }}
                  {{ Form::text('seo_title_ua', $page->translate('ua')->first()->seo_title ?? Input::old('seo_title_ua'), ['class' => 'form-control' ]) }}
                </div>
                <div class="col-md-6 form-group">
                  {{ Form::label('seo_description_ua', __('seo.seo_description')) }}
                  {{ Form::text('seo_description_ua', $page->translate('ua')->first()->seo_description ?? Input::old('seo_description_ua'), ['class' => 'form-control' ]) }}
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group">
        {{ Form::label('name', __('page.name')) }}
        {{ Form::text('name', $page->page ?? Input::old('name'), ['class' => 'form-control' ]) }}
      </div>
      <div class="col-md-6 form-group">
        <div class="file-load" data-file>
          <label class="file-load__label">
            {{Form::file('poster', ['class'=>'visually-hidden', 'data-file-input', 'accept'=>'image/*'])}}
            <span class="file-load__text">{{ __('page.photo') }}</span>
          </label>

          <div class="file-load__list" data-file-list>
            @if($page->getFirstMediaUrl('posters', 'thumb'))
              <ul>
                <li>
                  <img src="{{$page->getFirstMediaUrl('posters', 'thumb')}}" alt="photo">
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

    @set($i, 0)
    @foreach($page->blocks as $block)
      <div data-parent="true">
        @switch($block->attribute->name)
          @case('description')
            @include('admin.pages.blocks.description', ['block' => $block])
            @break
          @case('call-us')
            @include('admin.pages.blocks.call-us', ['block' => $block])
            @break
          @case('email')
            @include('admin.pages.blocks.email', ['block' => $block])
            @break
          @case('link')
            @include('admin.pages.blocks.link', ['block' => $block])
            @break
          @case('phone')
            @include('admin.pages.blocks.phone', ['block' => $block])
            @break
          @case('file')
            @include('admin.pages.blocks.file', ['block' => $block])
            @break
          @case('map_coordinates')
            @include('admin.pages.blocks.map_coordinates', ['block' => $block])
            @break
          @case('gallery')
            @include('admin.pages.blocks.gallery', ['block' => $block])
            @break
          @default
            @include('admin.pages.blocks.description', ['block' => $block])
            @break
        @endswitch
      </div>
      @set($i, $i+1)
    @endforeach

    <div class="panel panel-success" data-panel-block>
      <div class="panel-heading">{{ __('admin.new_customer_block') }}</div>
      <div class="panel-body" data-attributes-list="{{ $attributesObject }}">
        <div class="row">
          <div class="col-md-6 df fwn">
            <select name="attribute_id_${counter}" id="" class="form-control mr15" data-attributes-select></select>
            <button type="button" class="additional__block btn btn-primary">{{ __('admin.add_block') }}</button>
          </div>
        </div>
      </div>
    </div>

    {{Form::hidden('blockCounter', 0, ['id'=>'blockCounter'])}}
    {{Form::hidden('counter', 0, ['id'=>'counter'])}}

    {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}
    <a class="btn btn-warning " href="{{ route('pages.index') }}">{{ __('admin.cancel') }}</a>

    {{ Form::close() }}
@endsection
@section('styles')
    {!! Html::style('css/select2.min.css') !!}
    {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
{{-- {!! Html::script('js/plugins/mask.min.js') !!}
    {!! Html::script('js/plugins/moment.min.js') !!}
    {!! Html::script('js/plugins/select2.min.js') !!}
    {!! Html::script('js/admin/select2.js') !!}
    {!! Html::script('js/admin/article.js') !!} --}}

    {!! Html::script('js/admin/page.js') !!}

    {!! Html::script('/vendor/unisharp/laravel-ckeditor/ckeditor.js') !!}
    {!! Html::script('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') !!}
    <script>
      $(`[data-ckeditor]`).ckeditor();
    </script>
    {!! Html::script('js/admin/global.js') !!}
@stop
