@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">Цінові шаблони</h2>
        <div class="fsh">
            @can('price-pattern-create')
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create">
                    Створити новий
                </button>
            @endcan
        </div>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table" id="price-table">
        <thead>
        <tr>
            <th class="global__table-short">ID</th>
            <th>Назва</th>
            <th class="global__table-short">Дія</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pricePatterns as $key => $pricePattern)
            <tr>
                <td class="global__table-short">{{ $pricePattern->id }}</td>
                <td>{{ $pricePattern->title }}</td>
                <td class="global__table-short">
                    @can('price-pattern-show')
                        <a class="btn btn-info" href="{{ route('price-patterns.show',$pricePattern->id) }}"><i
                                    class="fa fa-cog"></i></a>
                    @endcan
                    @can('price-pattern-edit')
                        <a class="btn btn-primary" href="{{ route('price-patterns.edit', $pricePattern->id) }}"
                           data-td="edit"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('price-pattern-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['price-patterns.destroy', $pricePattern->id], 'data-confirm' => 'Ви впевнені, що хочете видалити?', 'style' => 'display:inline-block', 'data-td' => 'delete' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $pricePatterns->links() !!}
@endsection

@section('modal')
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Створення цінового шаблону</h4>
                </div>
                <div class="modal-body">
                    <div class="alert" role="alert" style="display: none">
                        <div class="alert-content"></div>
                    </div>
                    {{ Form::open(['url' => '/admin/price-patterns', 'files' => true, 'id' => 'create-price-pattern', 'data-form-price-patterns' => 'create']) }}
                    <div>
                        <div class="form-group">
                            {{ Form::label('title', 'Назва шаблону') }}
                            {{ Form::text('title', Input::old('title'), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="df jcend">
                        {{ Form::submit('Створити', ['class' => 'btn btn-success']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Редагування цінового шаблону</h4>
                </div>
                <div class="modal-body">
                    <div class="alert" role="alert" style="display: none">
                        <div class="alert-content"></div>
                    </div>
                    {{ Form::model('', ['route' => array('price-patterns.update', 0), 'method' => 'PUT', 'data-form-edit', 'data-form-price-patterns' => 'edit']) }}
                    <div>
                        <div class="form-group">
                            {{ Form::label('title', 'Назва шаблону') }}
                            {{ Form::text('title', Input::old('title'), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="df jcend">
                        {{ Form::submit('Редагувати', ['class' => 'btn btn-success']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <template id="template-create">
        <tr data-tr-template>
            <td class="global__table-short" data-td="id"></td>
            <td data-td="title"></td>
            <td class="global__table-short">

                <a class="btn btn-info" href="{{ route('price-patterns.show','current-id') }}" data-td="settings">
                    <i class="fa fa-cog"></i>
                </a>


                <a class="btn btn-primary" href="{{ route('price-patterns.edit', ['id' => 'current-id']) }}"
                   data-td="edit">
                    <i class="fa fa-pencil"></i>
                </a>
                {{ Form::open(['method' => 'DELETE', 'route' => ['price-patterns.destroy', 'current-id'], 'data-confirm' => 'Ви впевнені, що хочете видалити?', 'style' => 'display:inline-block', 'data-td' => 'delete'])}}

                {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                {{ Form::close() }}
            </td>
        </tr>
    </template>
@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
    {!! Html::script('js/admin/kasir.js') !!}
@stop

