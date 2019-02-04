@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.performanceTypesManagement') }}</h2>
        <div class="fsh">
            @can('performance-type-create')
                <a class="btn btn-success"
                   href="{{ route('performance-types.create') }}">{{ __('admin.createNewPerformanceType') }}</a>
            @endcan
        </div>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.name') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($performanceTypes as $performanceType)
            <tr>
                <td class="global__table-short">{{ $performanceType->id }}</td>
                <td>{{ $performanceType->translate->title }}</td>
                <td class="global__table-short">
                    @can('performance-type-edit')
                        <a class="btn btn-primary" href="{{ route('performance-types.edit',$performanceType->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('performance-type-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['performance-types.destroy', $performanceType->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $performanceTypes->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
