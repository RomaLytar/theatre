@extends('layouts.admin')
@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.performancesManagement') }}</h2>
        <div class="fsh">
            @can('performance-type-list')
                <a class="btn btn-primary"
                   href="{{ route('performance-types.index') }}">{{ __('admin.performanceTypes') }}</a>
            @endcan
            @can('performance-create')
                <a href="{{url('/admin/performance/create')}}" class="btn btn-success">{{__('admin.create')}}</a>
            @endcan
        </div>
    </div>

    <table class="table table-bordered global__table">
        <thead>
        <tr>
            <td class="global__table-short">ID</td>
            <td>{{__('performance.title')}}</td>
            <td class="col-md-5">{{__('performance.descriptions')}}</td>
            <td>{{__('performance.date')}}</td>
            <td class="global__table-short">{{__('performance.price')}}</td>
            <td class="global__table-short">{{__('performance.duration')}}</td>
            <td class="global__table-short">{{ __('admin.poster') }}</td>
            <td class="global__table-short">{{ __('admin.action') }}</td>
        </tr>
        </thead>
        <tbody>
        @foreach($performances as $performance)
            <tr>
                <td class="global__table-short">{{$performance->id}}</td>
                <td>{{$performance->translate->title}}</td>
                <td>{!! $performance->shortDescription() !!}</td>
                <td>{{$performance->period()}}</td>
                <td class="global__table-short">{{$performance->price}}</td>
                <td class="global__table-short">{{$performance->duration}}</td>
                <td class="global__table-short"><img src="{{ $performance->getFirstMediaUrl('posters', 'thumb') }}"
                                                     alt="{{ $performance->translate->title }}"
                                                     class="global__table-preview"></td>
                <td class="global__table-short">
                    @can('event-manage')
                        <a class="btn btn-info" href="{{ route('performance.show', $performance->id) }}"><i
                                    class="fa fa-cog"></i></a>
                    @endcan
                    @can('performance-edit')
                        <a class="btn btn-primary" href="{{ url("/admin/performance/{$performance->id}/edit") }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('performance-delete')
                        {{ Form::open([
                            'url' => '/admin/performance/' . $performance->id,
                            'data-confirm' => 'Are you sure you want to delete?',
                            'style' => 'display:inline-block'
                          ])
                        }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", [
                          'type' => 'submit',
                          'class' => 'btn btn-danger',
                          'data-confirm' => 'Are you sure you want to delete?'
                        ]) }}
                        {{ Form::close() }}
                    @endcan
                    @can('performance-actor-role-edit')
                        <a class="btn btn-small btn-warning"
                           href="{{ route('performance-roles.edit', ['id' => $performance->id]) }}">{{ __('admin.roles') }}</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $performances->links() !!}
@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
