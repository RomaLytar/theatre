@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h1 class="global__page-title">Редагування цінових зон шаблону: "{{ $pricePattern->title }}"</h1>
        <div class="fsh">
            <a class="btn btn-primary" href="{{ route('price-patterns.index') }}">Повернутися назад</a>
        </div>
    </div>

    @include('admin.message')

    @if($performanceCalendars->count() > 0)
        <div class="alert alert-danger">
            <p>Цей ціновий шаблон неможливо відредагувати, так як він уже використовується у наступних виступах:</p>
            <ul>
                @foreach($performanceCalendars as $date)
                    <li>{{ $date->performance->translate->title . ' - ' . $date->performance->hall->translate->title . ' - ' . $date->getFormatDateTime() }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ Form::model($pricePattern, ['route' => array('price-patterns.updatePriceZones', $pricePattern->id), 'method' => 'PUT']) }}
    <table class="table table-bordered global__table">
        <thead>
        <tr>
            <th class="global__table-short">ID</th>
            <th>Активовано?</th>
            <th>Назва кольору</th>
            <th>Колір</th>
            <th>Ціна</th>
        </tr>
        </thead>
        @foreach($pricePattern->priceZonesAll as $priceZone)
            <tr>
                <td class="global__table-short">{{ $priceZone->id }}</td>
                <td>
                    <label class="global__checkbox" style="margin: 0;">
                        {{ Form::checkbox('isActive_' . $priceZone->id, true, $priceZone->isActive, [$performanceCalendars->count() > 0 ? 'disabled' : '']) }}
                        <span class="global__checkbox-text"></span>
                    </label>
                </td>
                <td>{{ $priceZone->color->title }}</td>
                <td style="background-color: {{$priceZone->color->code}}"></td>
                <td>{{ Form::number('price_' . $priceZone->id, $priceZone->price, ['class' => 'form-control', $performanceCalendars->count() > 0 ? 'disabled' : '']) }}</td>
            </tr>
        @endforeach

    </table>

    @if($performanceCalendars->count() === 0)
        {{ Form::submit('Зберегти', ['class' => 'btn btn-success']) }}
    @endif

    {{ Form::close() }}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection
