@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.actorGroupsManagement') }}</h2>
        <div class="fsh">
            @can('actor-group-create')
                <a class="btn btn-success"
                   href="{{ route('actor_groups.create') }}">{{ __('admin.createNewActorGroup') }}</a>
            @endcan
        </div>
    </div>

    @include('admin.message')

    <div class="actor-group">
        <table class="table table-bordered global__table">
            <tr>
                <th class="global__table-short">ID</th>
                <th>{{ __('admin.name') }}</th>
                <th class="global__table-short">{{ __('admin.action') }}</th>
            </tr>
            @set($i, 1)
            @foreach ($actorGroups as $actorGroup)
                <tr>
                    <td class="global__table-short">{{ $i }}</td>
                    <td>
                        <b>{{ $actorGroup->translate->title }} - {{ $actorGroup->name }}</b>
                        @if(count($actorGroup->children_groups) > 0)
                            <ul class="actor-group__list">
                                @foreach($actorGroup->children_groups as $childrenGroup)
                                    <li>
                                        <div class="btn-group actor-group__item">
                                            <div type="button"
                                                 class="btn btn-default dropdown-toggle actor-group__item-name actor-group__btn"
                                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <b class="actor-group__item-name">{{ $childrenGroup->translate->title }}
                                                    - {{ $childrenGroup->name }}</b>
                                                <span class="caret"></span>
                                            </div>
                                            <div class="actor-group__item-btns">
                                                @can('actor-group-edit')
                                                    <a class="btn btn-primary"
                                                       href="{{ route('actor_groups.edit',$childrenGroup->id) }}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('actor-group-delete')
                                                    {{ Form::open(['method' => 'DELETE', 'route' => ['actor_groups.destroy', $childrenGroup->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                                                    {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                                                    {{ Form::close() }}
                                                @endcan
                                            </div>
                                            <ul class="dropdown-menu">
                                                @foreach($childrenGroup->children_groups as $subChildrenGroup)
                                                    <li class="actor-group__item">
                                                        <div class="actor-group__item-name">{{ $subChildrenGroup->translate->title }}
                                                            - {{ $subChildrenGroup->name }}</div>
                                                        <div class="actor-group__item-btns">
                                                            @can('permission-edit')
                                                                <a class="btn btn-primary"
                                                                   href="{{ route('actor_groups.edit',$subChildrenGroup->id) }}"><i
                                                                            class="fa fa-pencil"></i></a>
                                                            @endcan
                                                            @can('permission-delete')
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['actor_groups.destroy', $subChildrenGroup->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                                                                {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                                                                {{ Form::close() }}
                                                            @endcan
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td class="global__table-short">
                        {{--@can('permission-edit')--}}
                        <a class="btn btn-primary" href="{{ route('actor_groups.edit',$actorGroup->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                        {{--@endcan--}}
                        {{--@can('permission-delete')--}}
                        {{ Form::open(['method' => 'DELETE', 'route' => ['actor_groups.destroy', $actorGroup->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                        {{--@endcan--}}
                    </td>
                </tr>
                @set($i, $i + 1)
            @endforeach
        </table>
    </div>

    {{--{!! $actorGroups->links() !!}--}}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
