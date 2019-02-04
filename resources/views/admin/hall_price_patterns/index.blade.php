@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">Цінові шаблони залів</h2>
        <div class="fsh">
            @can('hall-price-pattern-create')
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create">
                    Створити нову прив'язку цінового шаблону до залу
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
            <th>Зал</th>
            <th>Шаблон</th>
            <th class="global__table-short">Дія</th>
        </tr>
        </thead>
        @foreach ($hallPricePatterns as $key => $hallPricePattern)
            <tr>
                <td class="global__table-short">{{ $hallPricePattern->id }}</td>
                <td>{{ $hallPricePattern->title }}</td>
                <td>{{ $hallPricePattern->hall->translate->title }}</td>
                <td>{{ $hallPricePattern->pricePattern->title }}</td>
                <td class="global__table-short">
                    @can('hall-price-pattern-show')
                        <a class="btn btn-info" href="{{ route('hall-price-patterns.show',$hallPricePattern->id) }}"><i
                                    class="fa fa-cog"></i></a>
                    @endcan
                    @can('hall-price-pattern-edit')
                        <a class="btn btn-primary" href="{{ route('hall-price-patterns.edit', $hallPricePattern->id) }}"
                           data-target="#create" data-td="edit"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('hall-price-pattern-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['hall-price-patterns.destroy', $hallPricePattern->id], 'data-confirm' => 'Ви впевнені, що хочете видалити?', 'style' => 'display:inline-block', 'data-td' => 'delete' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $hallPricePatterns->links() !!}
@endsection

@section('modal')
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Створення нової прив'язки залу до цінового шаблону</h4>
                </div>
                <div class="modal-body">
                    <div class="alert" role="alert" style="display: none">
                        <div class="alert-content"></div>
                    </div>
                    {{ Form::open(['url' => '/admin/hall-price-patterns', 'files' => true, 'id' => 'create-hall-price-pattern', 'data-form-price-patterns' => 'create']) }}
                    <div>
                        <div class="form-group">
                            {{ Form::label('title', 'Назва') }}
                            {{ Form::text('title', Input::old('title'), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="df fwn">
                        <div class="w100 mr15 form-group">
                            {{ Form::label('hall_id', 'Зал') }}
                            {{ Form::select('hall_id', $halls, Input::old('hall_id'), ['class' => 'form-control']) }}
                        </div>
                        <div class="w100 form-group">
                            {{ Form::label('price_pattern_id', 'Ціновий шаблон') }}
                            {{ Form::select('price_pattern_id', $pricePatterns, Input::old('price_pattern_id'), ['class' => 'form-control']) }}
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
                    <h4 class="modal-title" id="myModalLabel">Редагування прив'язки залу до цінового шаблону</h4>
                </div>
                <div class="modal-body">
                    <div class="alert" role="alert" style="display: none">
                        <div class="alert-content"></div>
                    </div>
                    {{ Form::model(0, ['route' => array('hall-price-patterns.update', 0), 'method' => 'PUT', 'data-form-edit', 'data-form-price-patterns' => 'edit']) }}
                    <div>
                        <div class="form-group">
                            {{ Form::label('title', 'Назва') }}
                            {{ Form::text('title', Input::old('title'), ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="df fwn">
                        <div class="w100 mr15 form-group">
                            {{ Form::label('hall_id', 'Зал') }}
                            {{ Form::select('hall_id', $halls, Input::old('hall_id'), ['class' => 'form-control']) }}
                        </div>
                        <div class="w100 form-group">
                            {{ Form::label('price_pattern_id', 'Ціновий шаблон') }}
                            {{ Form::select('price_pattern_id', $pricePatterns, Input::old('price_pattern_id'), ['class' => 'form-control']) }}
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
            <td data-td="hall_title"></td>
            <td data-td="price_pattern_title"></td>
            <td class="global__table-short">
                <a class="btn btn-info" href="{{ route('price-patterns.show', 'current-id') }}" data-td="settings">
                    <i class="fa fa-cog"></i>
                </a>
                <a class="btn btn-primary" href="{{ route('hall-price-patterns.edit', ['id' => 'current-id']) }}"
                   data-td="edit">
                    <i class="fa fa-pencil"></i>
                </a>
                {{ Form::open(['method' => 'DELETE', 'route' => ['hall-price-patterns.destroy', 'current-id'], 'data-confirm' => 'Ви впевнені, що хочете видалити?', 'style' => 'display:inline-block', 'data-td' => 'delete' ])}}
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
