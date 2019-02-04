@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{__('admin.editMenuItem')}}</h1>
  </div>

  <!-- if there are creation errors, they will show here -->
  {{ Html::ul($errors->all()) }}

  {{ Form::model($menuItem, ['route' => array('menu.update', $menuItem->id), 'method' => 'PUT']) }}
  <div>
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#en" aria-controls="home" role="tab"data-toggle="tab">EN</a></li>
      <li role="presentation"><a href="#ru" aria-controls="profile" role="tab" data-toggle="tab">RU</a></li>
      <li role="presentation"><a href="#ua" aria-controls="messages" role="tab" data-toggle="tab">UA</a></li>
    </ul>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="en">
        <div class="form-group">
          {{ Form::label('menu_en', __('menu.menu')) }}
          {{ Form::text('menu_en',isset($menuItem->translate('en')->first()->menu) ? $menuItem->translate('en')->first()->menu  : Input::old('menu_en'), ['class' => 'form-control' ]) }}
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ru">
        <div class="form-group">
          {{ Form::label('menu_ru', __('menu.menu')) }}
          {{ Form::text('menu_ru',isset($menuItem->translate('ru')->first()->menu) ? $menuItem->translate('ru')->first()->menu  : Input::old('menu_ru'), ['class' => 'form-control' ]) }}
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="ua">
        <div class="form-group">
          {{ Form::label('menu_ua', __('menu.menu')) }}
          {{ Form::text('menu_ua',isset($menuItem->translate('ua')->first()->menu) ? $menuItem->translate('ua')->first()->menu  : Input::old('menu_ua'), ['class' => 'form-control' ]) }}
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 form-group">
        {{ Form::label('parent_id', __('menu.menu_item_parent_item')) }}
        {{ Form::select('parent_id', $menuItems, Input::old('parent_id'), ['class' => 'form-control', 'placeholder' => 'Выберите из списка']) }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::label('url', __('menu.url')) }}
        {{ Form::text('url', Input::old('url'), ['class' => 'form-control']) }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::label('position', __('menu.position')) }}
        {{ Form::text('position', Input::old('position'), ['class' => 'form-control']) }}
      </div>
    </div>
  </div>

  {{ Form::submit(__('admin.update'), ['class' => 'btn btn-success']) }}

  {{ Form::close() }}
@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
  {!! Html::script('js/plugins/mask.min.js') !!}
  {!! Html::script('js/plugins/moment.min.js') !!}
@stop
