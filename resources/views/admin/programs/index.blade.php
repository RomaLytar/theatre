@extends('layouts.admin')
@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.program') }}</h2>
        @can('program-create')
            <div class="fsh">
                <a class="btn btn-success"
                   href="{{ route('programs.create') }}">{{ __('admin.create_new_program') }}</a>
            </div>
        @endcan
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.title') }}</th>
            <th>{{ __('admin.description') }}</th>
            <th>{{ __('admin.terms') }}</th>
            <th class="global__table-short">{{ __('admin.poster') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($programs as $program)
            <tr>
                <td class="global__table-short">{{ $program->id }}</td>
                <td>{{ $program->translate->title }}</td>
                <td>{{ $program->translate->description }}</td>
                <td>{{ $program->translate->terms_description }}</td>
                <td class="global__table-short"><img src="{{ $program->getFirstMediaUrl('posters','thumb') }}"
                                                     alt="{{ $program->translate->title }}"
                                                     class="global__table-preview"></td>
                <td class="global__table-short">
                    @can('program-edit')
                        <a class="btn btn-primary" href="{{ route('programs.edit',$program->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('program-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['programs.destroy', $program->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
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

