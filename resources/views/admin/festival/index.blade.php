@extends('layouts.admin')
@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.festivalsManagement') }}</h2>
        @can('festival-create')
            <div class="fsh">
                <a href="{{url('/admin/festival/create')}}" class="btn btn-success">{{__('admin.create')}}</a>
            </div>
        @endcan
    </div>

    <table class="table table-bordered global__table">
        <thead>
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{__('festival.title')}}</th>
            <th>{{__('festival.descriptions')}}</th>
            <th>{{__('festival.invitedStars')}}</th>
            <th>{{__('festival.created')}}</th>
            <th>{{__('festival.updated')}}</th>
            <th class="global__table-short">{{__('admin.poster')}}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($festivals as $festival)
            <tr>
                <td class="global__table-short">{{$festival->id}}</td>
                <td>{{$festival->translate->title}}</td>
                <td>{{ str_limit($festival->translate->descriptions, 100)}}</td>
                <td>{{ str_limit($festival->translate->invited_stars, 100)}}</td>
                <td>{{$festival->created_at}}</td>
                <td>{{$festival->updated_at}}</td>
                <td class="global__table-short"><img src="{{ $festival->getFirstMediaUrl('posters','thumb') }}"
                                                     alt="{{ $festival->translate->title }}"
                                                     class="global__table-preview"></td>
                <td class="global__table-short">
                    @can('festival-edit')
                        <a class="btn btn-primary"
                           href="{{ url("/admin/festival/{$festival->id}/edit") }}"
                        ><i class="fa fa-pencil"></i>
                        </a>
                    @endcan
                    @can('festival-delete')
                        {{ Form::open([
                            'url' => '/admin/festival/' . $festival->id,
                            'data-confirm' => 'Are you sure you want to delete?',
                            'style' => 'display:inline-block'
                          ])
                        }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", [
                          'type' => 'submit',
                          'class' => 'btn btn-danger'
                        ]) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
