@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">Звіт по продажу квитків
            за {{ $from !== $to ? 'період з ' . $from : $from }} {{ $from !== $to ? 'по ' . $to : '' }} у розрізі цін</h2>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table table_sort">
        <thead>
        <tr>
            <th>Назва</th>
            <th>Дата</th>
            <th>Час</th>
            <th>Зал</th>
            <th>Ціна</th>
            <th>Кількість проданих</th>
            <th>Сума проданих</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($ticketEventsCollection as $ticketEventCollection)
            @foreach ($ticketEventCollection->prices as $price => $ticketsCount)
                @if($ticketsCount !== 0)
                    <tr>
                        <td>{{ $ticketEventCollection->title }}</td>
                        <td>{{ $ticketEventCollection->date }}</td>
                        <td>{{ $ticketEventCollection->time }}</td>
                        <td>{{ $ticketEventCollection->hall }}</td>
                        <td>{{ $price }}</td>
                        <td>{{ $ticketsCount }}</td>
                        <td>{{ $ticketsCount * $price }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5"><b>Всього:</b></td>
            <td>{{ $total->totalAmount }}</td>
            <td>{{ $total->totalSum }}</td>
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
