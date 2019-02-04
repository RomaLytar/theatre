@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h1 class="global__page-title">{{ __('admin.usersManagement') }}</h1>
        <div class="fsh">
            @can('user-role-list')
                <a class="btn btn-primary" href="{{ route('roles.index') }}">{{ __('admin.roles') }}</a>
            @endcan
            @can('user-permission-list')
                <a class="btn btn-primary" href="{{ route('permissions.index') }}">{{ __('admin.permissions') }}</a>
            @endcan
            @can('user-create')
                <a class="btn btn-success" href="{{ route('users.create') }}">{{ __('admin.create') }}</a>
            @endcan
        </div>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>Логін</th>
            <th>Email</th>
            <th class="global__table-short">{{ __('admin.roles') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($data as $key => $user)
            @if(!$user->hasRole('super-admin'))
                <tr>
                    <td class="global__table-short">{{ ++$i }}</td>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="global__table-short">
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <span class="badge badge-success">{{ $v }}</span>
                            @endforeach
                        @endif
                    </td>
                    <td class="global__table-short">
                        @can('user-show')
                            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}"><i class="fa fa-cog"></i></a>
                        @endcan
                        @can('user-edit')
                            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}"><i
                                        class="fa fa-pencil"></i></a>
                        @endcan
                        @can('user-delete')
                            {{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                            {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        @endcan
                    </td>
                </tr>
            @endif
        @endforeach
    </table>

    {!! $data->render() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
