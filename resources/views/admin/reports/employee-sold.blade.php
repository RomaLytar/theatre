@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">Звіт по продажу квитків за {{ $from !== $to ? 'період з ' . $from : $from }} {{ $from !== $to ? 'по ' . $to : '' }} по касиру - {{ \Illuminate\Support\Facades\Auth::user()->fullName() }}</h2>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table table_sort">
        <thead>
        <tr>
            <th rowspan="2">Дата</th>
            <th rowspan="2">Час</th>
            <th rowspan="2">Назва</th>
            <th colspan="5">Кількість проданих, шт.</th>
            <th colspan="5">Сума проданих, грн.</th>
        </tr>
        <tr>
            <th>Готівкою</th>
            <th>Карткою</th>
            <th>Продано</th>
            <th>Повернуто</th>
            <th>Всього</th>
            <th>Готівкою</th>
            <th>Карткою</th>
            <th>Продано</th>
            <th>Повернуто</th>
            <th>Всього</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($eventsCollection as $item)
            <tr>
                <td>{{ $item->date  }}</td>
                <td>{{ $item->time  }}</td>
                <td>{{ $item->title  }}</td>
                <td>{{ $item->cashAmount }}</td>
                <td>{{ $item->cardAmount }}</td>
                <td>{{ $item->totalAmount }}</td>
                <td>{{ $item->returnedAmount }}</td>
                <td>{{ $item->totalAmount - $item->returnedAmount }}</td>
                <td>{{ $item->cashSum }}</td>
                <td>{{ $item->cardSum }}</td>
                <td>{{ $item->totalSum }}</td>
                <td>{{ $item->returnedSum }}</td>
                <td>{{ $item->totalSum - $item->returnedSum }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3"><b>Всього:</b></td>
            <td>{{ $total->cashAmount }}</td>
            <td>{{ $total->cardAmount }}</td>
            <td>{{ $total->cashAmount + $total->cardAmount }}</td>
            <td>{{ $total->returnedAmount }}</td>
            <td>{{ $total->cashAmount + $total->cardAmount - $total->returnedAmount }}</td>
            <td>{{ $total->cashSum }}</td>
            <td>{{ $total->cardSum }}</td>
            <td>{{ $total->cashSum + $total->cardSum }}</td>
            <td>{{ $total->returnedSum }}</td>
            <td>{{ $total->cashSum + $total->cardSum - $total->returnedSum }}</td>
        </tr>
        </tfoot>
    </table>

    @if($from === $to && $user->leftoverDay($from) !== null)
        <p>Сума каси на початок дня: {{ $user->leftoverDay($from)->start_sum }} грн.</p>
        <p>Сума каси на кінець дня: {{ $total->cashSum + $user->leftoverDay($from)->start_sum }} грн.</p>
    @endif
@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
    {!! Html::script('js/admin/table-sorting.js') !!}
@stop
