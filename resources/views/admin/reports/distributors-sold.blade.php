@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">Звіт по продажу квитків
            за {{ $from !== $to ? 'період з ' . $from : $from }} {{ $from !== $to ? 'по ' . $to : '' }} за
            розповсюджувачами</h2>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table table_sort">
        <thead>
        <tr>
            <th>Розповсюджувач</th>
            <th>Назва</th>
            <th>Дата</th>
            <th>Час</th>
            <th>Кількість проданих</th>
            <th>Сума проданих</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($distributors as $distributorEvents)
            @foreach ($distributorEvents as $item)
                <tr>
                    <td>{{ $item['distributor'] }}</td>
                    <td>{{ $item['title']  }}</td>
                    <td>{{ $item['date']  }}</td>
                    <td>{{ $item['time']  }}</td>
                    <td>{{ $item['totalAmount'] }}</td>
                    <td>{{ $item['totalSum'] }}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4"><b>Всього:</b></td>
            <td>{{ $total['totalAmount'] }}</td>
            <td>{{ $total['totalSum'] }}</td>
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
