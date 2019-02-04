@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h1 class="global__page-title">Список подій виступу: "{{ $performance->translate->title }}"</h1>
        <div class="fsh">
            <a class="btn btn-primary" href="{{ route('performance.index') }}">Повернутися назад</a>
        </div>
    </div>

    @include('admin.message')

    {{ Form::model($performance, ['route' => array('performance.updateDates', $performance->id), 'method' => 'PUT']) }}
    <table class="table table-bordered global__table">
        <thead>
        <tr>
            <th class="global__table-short">ID</th>
            <th>Продаж у касі</th>
            <th>Онлайн продаж</th>
            <th>Дата</th>
            <th>Час початку</th>
            <th>Ціновий шаблон</th>
            <th>Дії з квитками</th>
            <th>Звіт</th>
        </tr>
        </thead>
        @foreach($performance->dates as $date)
            <tr>
                <td class="global__table-short">{{ $date->id }}</td>
                <td>
                    <label class="global__checkbox" style="margin: 0;">
                        {{ Form::checkbox('isSoldInCashBox_' . $date->id, true, $date->isSoldInCashBox, ['disabled' => $date->areTicketsGenerated ? false : true]) }}
                        <span class="global__checkbox-text"></span>
                    </label>
                </td>
                <td>
                    <label class="global__checkbox" style="margin: 0;">
                        {{ Form::checkbox('isSoldOnline_' . $date->id, true, $date->isSoldOnline, ['disabled' => $date->areTicketsGenerated ? false : true]) }}
                        <span class="global__checkbox-text"></span>
                    </label>
                </td>
                <td>{{ $date->getFormatDate() }}</td>
                <td>{{ $date->getFormatTime() }}</td>
                <td>
                    @if(!$date->areTicketsGenerated)
                        {{ Form::select('hall_price_pattern_id_' . $date->id, $hallPricePatterns, $date->hall_price_pattern_id, ['placeholder' => 'Оберіть ціновий шаблон', 'class' => 'form-control']) }}
                    @else
                        {{ Form::hidden('hall_price_pattern_id_' . $date->id, $date->hall_price_pattern_id ) }}
                        {{ $date->hallPricePattern->title }}
                    @endif
                </td>
                <td>
                    @if($date->hall_price_pattern_id && !$date->areTicketsGenerated)
                        <a class="btn btn-success" href="{{ route('performanceCalendar.generateTickets', ['id' => $date->id]) }}">Згенерувати квитки</a>
                    @endif
                    @if($date->hall_price_pattern_id && $date->areTicketsGenerated)
                        <a class="btn btn-primary" href="{{ route('performanceCalendar.manageTickets', ['id' => $date->id]) }}">Управління квитками</a>
                        @if(!$date->isSoldInCashBox && !$date->isSoldOnline)
                            <a class="btn btn-danger" href="{{ route('performanceCalendar.dropTickets', ['id' => $date->id]) }}">Видалити квитки</a>
                        @endif
                    @endif
                </td>
                <td>
                    @if($date->date < \Illuminate\Support\Carbon::now() && $date->areTicketsGenerated)
                        <a class="btn btn-primary" href="{{ route('reports.event-sold-price-groups', ['eventId' => $date->id]) }}">Сформувати</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    {{ Form::submit('Зберегти', ['class' => 'btn btn-success']) }}

    {{ Form::close() }}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection
