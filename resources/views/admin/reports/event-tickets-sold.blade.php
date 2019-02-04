@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">Звіт по продажу квитків
            за {{ $from !== $to ? 'період з ' . $from : $from }} {{ $from !== $to ? 'по ' . $to : '' }} по виступам</h2>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table table_sort">
        <thead>
        <tr>
            <th rowspan="2">Назва</th>
            <th rowspan="2">Дата</th>
            <th rowspan="2">Час</th>
            <th rowspan="2">Зал</th>
            <th {{ $param === 'all' ? 'colspan=4' : '' }}>Кількість проданих</th>
            <th {{ $param === 'all' ? 'colspan=4' : '' }}>Сума проданих</th>
        </tr>
        <tr>
            @if($param === 'cash' || $param === 'all') <th>Готівкою</th> @endif
            @if($param === 'card' || $param === 'all') <th>Карткою</th> @endif
            @if($param === 'online' || $param === 'all') <th>Онлайн</th> @endif
            @if($param === 'all') <th>Всього</th> @endif
            @if($param === 'cash' || $param === 'all') <th>Готівкою</th> @endif
            @if($param === 'card' || $param === 'all') <th>Карткою</th> @endif
            @if($param === 'online' || $param === 'all') <th>Онлайн</th> @endif
            @if($param === 'all') <th>Всього</th> @endif
        </tr>
        </thead>
        <tbody>
        @foreach ($eventsCollection as $item)
            <tr>
                <td>{{ $item->title  }}</td>
                <td>{{ $item->date  }}</td>
                <td>{{ $item->time  }}
                <td>{{ $item->hall  }}</td>
                @if($param === 'cash' || $param === 'all') <td>{{ $item->cashAmount }}</td> @endif
                @if($param === 'card' || $param === 'all') <td>{{ $item->cardAmount }}</td> @endif
                @if($param === 'online' || $param === 'all') <td>{{ $item->onlineAmount }}</td> @endif
                @if($param === 'all') <td>{{ $item->cashAmount + $item->cardAmount + $item->onlineAmount }}</td> @endif
                @if($param === 'cash' || $param === 'all') <td>{{ $item->cashSum }}</td> @endif
                @if($param === 'card' || $param === 'all') <td>{{ $item->cardSum }}</td> @endif
                @if($param === 'online' || $param === 'all') <td>{{ $item->onlineSum }}</td> @endif
                @if($param === 'all') <td>{{ $item->cashSum + $item->cardSum + $item->onlineSum }}</td> @endif
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4"><b>Всього:</b></td>
            @if($param === 'cash' || $param === 'all') <td>{{ $total->cashAmount }}</td> @endif
            @if($param === 'card' || $param === 'all') <td>{{ $total->cardAmount }}</td> @endif
            @if($param === 'online' || $param === 'all') <td>{{ $total->onlineAmount }}</td> @endif
            @if($param === 'all') <td>{{ $total->cashAmount + $total->cardAmount + $total->onlineAmount }}</td> @endif
            @if($param === 'cash' || $param === 'all') <td>{{ $total->cashSum }}</td> @endif
            @if($param === 'card' || $param === 'all') <td>{{ $total->cardSum }}</td> @endif
            @if($param === 'online' || $param === 'all') <td>{{ $total->onlineSum }}</td> @endif
            @if($param === 'all') <td>{{ $total->cashSum + $total->cardSum + $total->onlineSum }}</td> @endif
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
