@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.vacanciesManagement') }}</h2>
        <div class="fsh">
            @can('vacancy-create')
                <a class="btn btn-success" href="{{ route('vacancies.create') }}">{{ __('admin.create') }}</a>
            @endcan
        </div>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.title') }}</th>
            <th>{{ __('admin.description') }}</th>
            <th class="global__table-short">{{ __('admin.active') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($vacancies as $vacancy)
            <tr>
                <td class="global__table-short">{{ $vacancy->id }}</td>
                <td>{{ $vacancy->translate->title }}</td>
                <td>{{ $vacancy->translate->description }}</td>
                <td class="global__table-short">{!! ($vacancy->is_active) == 1 ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
                <td class="global__table-short">
                    @can('vacancy-edit')
                        <a class="btn btn-primary" href="{{ route('vacancies.edit',$vacancy->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('vacancy-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['vacancies.destroy', $vacancy->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
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
