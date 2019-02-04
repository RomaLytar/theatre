@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h1 class="global__page-title">{{ __('admin.permissionsManagement') }}</h1>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.name') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($permissions as $key => $permission)
            <tr>
                <td class="global__table-short">{{ $permission->id }}</td>
                <td>{{ __('permissions.' . $permission->name) }}</td>
                <td class="global__table-short">
                    @can('user-permission-edit')
                        <a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $permissions->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
