@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.messages') }}</h2>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.name_people') }}</th>
            <th>Email</th>
            <th>{{ __('admin.phone') }}</th>
            <th>{{ __('admin.messages') }}</th>
            <th class="global__table-short">{{ __('admin.read') }}</th>
            <th class="global__table-short">{{ __('admin.send') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($messages as $message)
            <tr>
                <td class="global__table-short">{{ $message->id }}</td>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->phone }}</td>
                <td>{{ $message->description }}</td>
                <td class="global__table-short">{!! ($message->read) == 1 ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
                <td class="global__table-short">{!! ($message->send) == 1 ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
                <td class="global__table-short">
                    @can('feed-back-edit')
                        {{ Form::open(['method' => 'GET', 'route' => ['messages.edit', $message->id], 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-pencil\"></i>", ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    @endcan
                    @can('feed-back-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['messages.destroy', $message->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
