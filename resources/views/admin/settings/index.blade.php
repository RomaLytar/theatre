@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.settingsManagement') }}</h2>
        <div class="fsh">
            @can('setting-create')
                <a class="btn btn-success" href="{{ route('settings.create') }}">{{ __('admin.create') }}</a>
            @endcan
        </div>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.slug') }}</th>
            <th>{{ __('admin.name') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($settings as $setting)
            <tr>
                <td class="global__table-short">{{ $setting->id }}</td>
                <td>{{ $setting->slug }}</td>
                <td>{{ $setting->translate->title }}</td>
                <td class="global__table-short">
                    @can('setting-edit')
                        <a class="btn btn-small btn-primary" href="{{ route('settings.edit',$setting->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('setting-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['settings.destroy', $setting->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $settings->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
