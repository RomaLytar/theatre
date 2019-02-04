@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.actorRolesManagement') }}</h2>
        <div class="fsh">
            @can('actor-role-create')
                <a class="btn btn-success"
                   href="{{ route('actor-roles.create') }}">{{ __('admin.createNewActorRole') }}</a>
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
        @foreach ($actorRoles as $actorRole)
            <tr>
                <td class="global__table-short">{{ $actorRole->id }}</td>
                <td>{{ $actorRole->translate->title }}</td>
                <td class="global__table-short">
                    @can('actor-role-edit')
                        <a class="btn btn-primary" href="{{ route('actor-roles.edit',$actorRole->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('actor-role-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['actor-roles.destroy', $actorRole->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $actorRoles->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
