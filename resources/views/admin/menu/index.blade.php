@extends('layouts.admin')
@section('content')
    <div class="df mb15">
        <h1 class="global__page-title">{{ __('admin.menuManagement') }}</h1>
        <div class="fsh">
            @can('menu-item-create')
                <a class="btn btn-success btn-create" href="{{ route('menu.create') }}">{{ __('admin.create') }}</a>
            @endif
        </div>
    </div>

    <table class="table table-bordered global__table">
        <thead>
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.title') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($menuItems as $menuItem)
            <tr>
                <td class="hidden-xs global__table-short">{{$menuItem->position}}</td>
                <td>
                    <b>{{$menuItem->translate->menu}}</b>
                    @if(count($menuItem->children_items) > 0)
                        <table class="table table-bordered global__table">
                            <thead>
                            <tr>
                                <th class="global__table-short">ID</th>
                                <th>{{ __('admin.title') }}</th>
                                <th class="global__table-short">{{ __('admin.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menuItem->children_items as $childrenMenuItem)
                                <tr>
                                    <td class="hidden-xs global__table-short">{{$childrenMenuItem->position}}</td>
                                    <td class="hidden-xs">{{$childrenMenuItem->translate->menu}}</td>
                                    <td class="global__table-short">
                                        @can('menu-item-edit')
                                            <a class="btn btn-primary"
                                               href="{{ route('menu.edit', $childrenMenuItem->id) }}"><i
                                                        class="fa fa-pencil"></i></a>
                                        @endcan
                                        @can('menu-item-delete')
                                            {{Form::open(['route'=>['menu.destroy', $childrenMenuItem->id], 'method'=>'delete', 'style' => 'display:inline-block'])}}
                                            {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                                            {{Form::close()}}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </td>
                <td class="global__table-short">
                    <a class="btn btn-primary" href="{{ route('menu.edit', $menuItem->id) }}"><i
                                class="fa fa-pencil"></i></a>
                    {{Form::open(['route'=>['menu.destroy', $menuItem->id], 'method'=>'delete', 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block'])}}
                    {{--<button onclick="return confirm('Вы уверены?')" type="submit" class="btn btn-danger">
                      <i class="fa fa-trash"></i>
                    </button>--}}
                    {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                    {{Form::close()}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('styles')
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
@stop
