@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">Звіт по продажу квитків на виставу '{{ $ticketEventCollection->title }}' {{ $ticketEventCollection->date }} о {{ $ticketEventCollection->time }} ({{ $ticketEventCollection->hall }}) у розрізі цін</h2>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table table_sort">
        <thead>
        <tr>
            <th rowspan="3">Ціна</th>
            <th colspan="6">Кількість проданих</th>
            <th colspan="6">Сума проданих</th>
        </tr>
        <tr>
            <th colspan="2">Каса</th>
            <th colspan="2">Розповсюджувачі</th>
            <th rowspan="2">Онлайн</th>
            <th rowspan="2">Всього</th>
            <th colspan="2">Каса</th>
            <th colspan="2">Розповсюджувачі</th>
            <th rowspan="2">Онлайн</th>
            <th rowspan="2">Всього</th>
        </tr>
        <tr>
            <th>Готівкою</th>
            <th>Карткою</th>
            <th>Готівкою</th>
            <th>Карткою</th>
            <th>Готівкою</th>
            <th>Карткою</th>
            <th>Готівкою</th>
            <th>Карткою</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($ticketEventCollection->prices as $price => $priceGroups)
            <tr>
                <td>{{ $price }}</td>
                <td>{{ $priceGroups->cashAmount }}</td>
                <td>{{ $priceGroups->cardAmount }}</td>
                <td>{{ $priceGroups->distrCashAmount }}</td>
                <td>{{ $priceGroups->distrCardAmount }}</td>
                <td>{{ $priceGroups->onlineAmount }}</td>
                <td>{{ $priceGroups->cashAmount + $priceGroups->cardAmount + $priceGroups->distrCashAmount + $priceGroups->distrCardAmount + $priceGroups->onlineAmount }}</td>
                <td>{{ $priceGroups->cashSum }}</td>
                <td>{{ $priceGroups->cardSum }}</td>
                <td>{{ $priceGroups->distrCashSum }}</td>
                <td>{{ $priceGroups->distrCardSum }}</td>
                <td>{{ $priceGroups->onlineSum }}</td>
                <td>{{ $priceGroups->cashSum + $priceGroups->cardSum + $priceGroups->distrCashSum + $priceGroups->distrCardSum + $priceGroups->onlineSum }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td><b>Всього:</b></td>
            <td>{{ $total->cashAmount }}</td>
            <td>{{ $total->cardAmount }}</td>
            <td>{{ $total->distrCashAmount }}</td>
            <td>{{ $total->distrCardAmount }}</td>
            <td>{{ $total->onlineAmount }}</td>
            <td>{{ $total->cashAmount + $total->cardAmount + $total->distrCashAmount + $total->distrCardAmount + $total->onlineAmount }}</td>
            <td>{{ $total->cashSum }}</td>
            <td>{{ $total->cardSum }}</td>
            <td>{{ $total->distrCashSum }}</td>
            <td>{{ $total->distrCardSum }}</td>
            <td>{{ $total->onlineSum }}</td>
            <td>{{ $total->cashSum + $total->cardSum + $total->distrCashSum + $total->distrCardSum + $total->onlineSum }}</td>
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
