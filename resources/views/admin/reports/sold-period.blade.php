@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">Звіт по продажу квитків за {{ $from !== $to ? 'період з ' . $from : $from }} {{ $from !== $to ? 'по ' . $to : '' }}</h2>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table table_sort">
        <thead>
            <tr>
                <th rowspan="2">Назва</th>
                <th rowspan="2">Дата</th>
                <th rowspan="2">Час</th>
                <th rowspan="2">Зал</th>
                <th colspan="4">Кількість проданих</th>
                <th colspan="4">Сума проданих</th>
            </tr>
            <tr>
                <th>Готівкою</th>
                <th>Карткою</th>
                <th>Онлайн</th>
                <th>Всього</th>
                <th>Готівкою</th>
                <th>Карткою</th>
                <th>Онлайн</th>
                <th>Всього</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventsCollection as $item)
                <tr>
                    <td>{{ $item->title  }}</td>
                    <td>{{ $item->date  }}</td>
                    <td>{{ $item->time  }}</td>
                    <td>{{ $item->hall  }}</td>
                    <td>{{ $item->cashAmount }}</td>
                    <td>{{ $item->cardAmount }}</td>
                    <td>{{ $item->onlineAmount }}</td>
                    <td>{{ $item->totalAmount }}</td>
                    <td>{{ $item->cashSum }}</td>
                    <td>{{ $item->cardSum }}</td>
                    <td>{{ $item->onlineSum }}</td>
                    <td>{{ $item->totalSum }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"><b>Всього:</b></td>
                <td>{{ $total->cashAmount }}</td>
                <td>{{ $total->cardAmount }}</td>
                <td>{{ $total->onlineAmount }}</td>
                <td>{{ $total->cashAmount + $total->cardAmount + $total->onlineAmount }}</td>
                <td>{{ $total->cashSum }}</td>
                <td>{{ $total->cardSum }}</td>
                <td>{{ $total->onlineSum }}</td>
                <td>{{ $total->cashSum + $total->cardSum + $total->onlineSum }}</td>
            </tr>
        </tfoot>
    </table>
@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
    {!! Html::script('js/admin/table-sorting.js') !!}
@stop
