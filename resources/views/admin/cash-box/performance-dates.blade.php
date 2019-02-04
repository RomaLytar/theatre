@extends('layouts.admin')
@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">Список дат виступу "{{ $performance->translate->title }}", на які відкрито продаж у касі</h2>
    </div>

    <table class="table table-bordered global__table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Дата</td>
            <td>Час початку</td>
            <td>Вільні місця</td>
            <td class="global__table-short">Дії</td>
        </tr>
        </thead>
        <tbody>
        @foreach($performance->cashBoxAvailableDates as $date)
            <tr>
                <td class="global__table-short">{{ $date->id }}</td>
                <td class="global__table-short">{{ $date->getFormatDate() }}</td>
                <td class="global__table-short">{{ $date->getFormatTime() }}</td>
                <td class="global__table-short">{{ $date->availableTickets->count() }}</td>
                <td class="global__table-short">
                    <a class="btn btn-info" href="{{ route('cash-box.dates.show.tickets', $date->id) }}"><i class="fa fa-cog"></i> Обрати квитки</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
