@extends('layouts.admin')
@section('content')
    <div class="df mb15">
        <h1 class="global__page-title">{{__('admin.answer')}}</h1>
    </div>
    <div class="list_message">
         <li>
            <span>{{ __('admin.name_people') }}:</span>
            <span>{{ $message->name }}</span>
         </li>
         <li>
            <span>E-mail:</span>
            <span>{{ $message->email }}</span>
         </li>
         <li>
            <span>{{ __('admin.phone') }}:</span>
            <span>{{ $message->phone }}</span>
         </li>
        <li>
            <span>{{ __('admin.messages') }}:</span>
            <span>{{ $message->description }}</span>
        </li>
    </div>
    <hr>
{{ Form::model($message,['method' => 'PUT', 'route' => ['messages.update', $message->id], 'id' => 'messages']) }}
<div role="tabpanel" class="tab-pane active" id="en">
    <div class="row">
        <div class="col-md-12 form-group">
            {{ Form::label('answer', __('admin.answer')) }}
            {{ Form::textarea('answer',isset($message->answer) ? $message->answer  : Input::old('answer'), ['class' => 'form-control' ]) }}
            {{ Form::hidden('email',isset($message->email) ? $message->email : Input::old('email')) }}
            {{ Form::hidden('name',isset($message->name) ? $message->name : Input::old('email')) }}
        </div>
    </div>
</div>
{{ Form::submit(__('admin.send'), ['class' => 'btn btn-success']) }}
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
            CKEDITOR.replace( 'answer' );
        </script>
@stop