@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.seasonsManagement') }}</h2>
        <div class="fsh">
            @can('season-create')
                <a class="btn btn-success" href="{{ route('seasons.create') }}">{{ __('admin.create') }}</a>
            @endcan
        </div>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.name') }}</th>
            <th class="global__table-short">{{ __('admin.number') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($seasons as $key => $season)
            <tr>
                <td class="global__table-short">{{ $season->id }}</td>
                <td>{{ $season->translate->title }}</td>
                <td class="global__table-short">{{ $season->number }}</td>
                <td class="global__table-short">
                    @can('season-edit')
                        <a class="btn btn-primary" href="{{ route('seasons.edit',$season->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('season-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['seasons.destroy', $season->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $seasons->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
