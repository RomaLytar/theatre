@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">Детальний звіт по продажу квитків за {{ $from !== $to ? 'період з ' . $from : $from }} {{ $from !== $to ? 'по ' . $to : '' }}</h2>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table table_sort">
        <thead>
            <tr>
                <th rowspan="2">ПІБ</th>
                <th rowspan="2">Розповсюджувач</th>
                <th rowspan="2">Назва</th>
                <th rowspan="2">Дата</th>
                <th rowspan="2">Час</th>
                <th rowspan="2">Ціна</th>
                <th colspan="4">Кількість проданих</th>
                <th colspan="4">Сума проданих</th>
            </tr>
            <tr>
                <th>Готівкою</th>
                <th>Карткою</th>
                <th>Всього</th>
                <th>Готівкою</th>
                <th>Карткою</th>
                <th>Всього</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketEventsCollection as $item)
                @foreach($item->prices as $price => $priceItem)
                    @foreach($priceItem->distributors as $distributor)
                        <tr>
                            <td>{{ $distributor->seller  }}</td>
                            <td>{{ $distributor->buyer  }}</td>
                            <td>{{ $item->title  }}</td>
                            <td>{{ $item->date  }}</td>
                            <td>{{ $item->time  }}</td>
                            <td>{{ $price  }}</td>
                            <td>{{ $distributor->cashAmount }}</td>
                            <td>{{ $distributor->cardAmount }}</td>
                            <td>{{ $distributor->cashAmount + $distributor->cardAmount }}</td>
                            <td>{{ $distributor->cashSum }}</td>
                            <td>{{ $distributor->cardSum }}</td>
                            <td>{{ $distributor->cashSum + $distributor->cardSum }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"><b>Всього:</b></td>
                <td>{{ $total->cashAmount }}</td>
                <td>{{ $total->cardAmount }}</td>
                <td>{{ $total->cashAmount + $total->cardAmount + $total->onlineAmount }}</td>
                <td>{{ $total->cashSum }}</td>
                <td>{{ $total->cardSum }}</td>
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
