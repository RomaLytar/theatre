@extends('layouts.admin')
@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{__('admin.homepage')}}</h2>
        <div class="fsh">
            @can('home-page-edit')
                <a href="{{ url('/admin/homepage/edit') }}" class="btn btn-success">{{ __('admin.editHomepage') }}</a>
            @endcan
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">{{__('admin.promoSlider')}}</div>
        <div class="panel-body">
            <div class="performances row">
                @foreach($components as $component)
                    @if($component->type === \App\Models\HomePage::PROMO_SLIDER_TYPE)
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ $component->performanceDate->performance->poster }}" alt=""
                                         class="img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <p><strong>{{ $component->performanceDate->performance->translate->title }}</strong>
                                    </p>
                                    <p>{{$component->performanceDate->date}}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="panel panel-success">
        <div class="panel-heading">{{__('admin.promoSliderMini')}}</div>
        <div class="panel-body">
            <div class="performances row">
                @foreach($components as $component)
                    @if($component->type === \App\Models\HomePage::PROMO_SLIDER_MINI_TYPE)
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ $component->performanceDate->performance->poster }}" alt=""
                                         class="img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <p><strong>{{ $component->performanceDate->performance->translate->title }}</strong>
                                    </p>
                                    <p>{{$component->performanceDate->date}}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">{{__('admin.recommended')}}</div>
        <div class="panel-body">
            <div class="performances row">
                @foreach($components as $component)
                    @if($component->type === \App\Models\HomePage::RECOMMENDED_TYPE)
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ $component->performanceDate->performance->poster }}" alt=""
                                         class="img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <p><strong>{{ $component->performanceDate->performance->translate->title }}</strong>
                                    </p>
                                    <p>{{$component->performanceDate->date}}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="panel panel-warning">
        <div class="panel-heading">{{__('admin.specialProjects')}}</div>
        <div class="panel-body">
            <div class="performances row">
                @foreach($components as $component)
                    @if($component->type === \App\Models\HomePage::SPECIAL_PROJECTS_TYPE)
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ $component->performanceDate->performance->poster }}" alt=""
                                         class="img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <p><strong>{{ $component->performanceDate->performance->translate->title }}</strong>
                                    </p>
                                    <p>{{$component->performanceDate->date}}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')

@stop
