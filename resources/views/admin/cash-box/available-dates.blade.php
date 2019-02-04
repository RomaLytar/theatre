@extends('layouts.admin')
@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">Список виступів, на які відкрито продаж у касі</h2>
        <div class="col-md-6">
            {{ Form::open(['method' => 'GET', 'route' => ['cash-box.dates.search']])}}
            <div class="form-group">
                {{ Form::label('query', 'Введіть назву виступу') }}
                {{ Form::text('query', Input::old('query'), ['class' => 'form-control', 'minlength' => 3, 'required']) }}
            </div>
            {{ Form::submit('Шукати', ['class' => 'btn btn-success']) }}
            {{ Form::close() }}
        </div>
    </div>

    <table class="table table-bordered global__table">
        <thead>
        <tr>
            <td class="global__table-short">ID</td>
            <td>Постер</td>
            <td>Назва виступу</td>
            <td>Дата</td>
            <td>Час початку</td>
            <td>Вільні місця</td>
            <td class="global__table-short">Дії</td>
        </tr>
        </thead>
        <tbody>
        @foreach($dates as $date)
            <tr>
                <td class="global__table-short">{{ $date->id }}</td>
                <td class="global__table-short">
                    <img src="{{ $date->performance->getFirstMediaUrl('posters', 'thumb') }}"
                         alt="{{ $date->performance->translate->title }}"
                         class="global__table-preview">
                </td>
                <td class="global__table-short">{{ $date->performance->translate->title }}</td>
                <td class="global__table-short">{{ $date->getFormatDate() }}</td>
                <td class="global__table-short">{{ $date->getFormatTime() }}</td>
                <td class="global__table-short">{{ $date->availableTickets->count() }}</td>
                <td class="global__table-short">
                    <a class="btn btn-info" href="{{ route('cash-box.dates.show.tickets', $date->id) }}"><i class="fa fa-cog"></i> Обрати квитки</a>
                    <a class="btn btn-info" href="{{ route('cash-box.performances.show.dates', ['id' => $date->performance_id]) }}">
                        <i class="fa fa-cog"></i> Переглянути усі дати виступу
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $dates->links() !!}
@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
