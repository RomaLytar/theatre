@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h1 class="global__page-title">Список звітів</h1>
        <div class="fsh">
            <a class="btn btn-primary" href="{{ URL::previous() }}">Повернутися назад</a>
        </div>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th rowspan="2">Назва звіту</th>
            <th colspan="2">Період</th>
            <th rowspan="2">Дія</th>
        </tr>
        <tr>
            <th>З</th>
            <th>По</th>
        </tr>
        @can('report-list-own')
            <tr>
                {{ Form::open(['route' => 'reports.employee-sold', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Звіт по продажу квитків за <b>день</b> по касиру - {{ \Illuminate\Support\Facades\Auth::user()->fullName() }}</td>
                <td>{{ Form::hidden('from', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::hidden('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>
            <tr>
                {{ Form::open(['route' => 'reports.employee-sold', 'id' => 'form-report', 'method' => 'GET']) }}
                    <td>Звіт по продажу квитків за <b>період</b> по касиру - {{ \Illuminate\Support\Facades\Auth::user()->fullName() }}</td>
                    <td>{{ Form::date('from', \Illuminate\Support\Carbon::now()->startOfMonth()->format('Y-m-d')) }}</td>
                    <td>{{ Form::date('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                    <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>
        @endcan
        @can('report-list-total')
            <tr>
                {{ Form::open(['route' => 'reports.sold-period', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Звіт по продажу квитків за <b>день</b> для ст. касира</td>
                <td>{{ Form::hidden('from', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::hidden('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>
            <tr>
                {{ Form::open(['route' => 'reports.sold-period', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Звіт по продажу квитків за <b>період</b> для ст. касира</td>
                <td>{{ Form::date('from', \Illuminate\Support\Carbon::now()->startOfMonth()->format('Y-m-d')) }}</td>
                <td>{{ Form::date('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>

            <tr>
                {{ Form::open(['route' => 'reports.distributors-sold', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Звіт по продажу квитків за <b>день</b> по розповсюджувачам</td>
                <td>{{ Form::hidden('from', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::hidden('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>
            <tr>
                {{ Form::open(['route' => 'reports.distributors-sold', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Звіт по продажу квитків за <b>період</b> по розповсюджувачам</td>
                <td>{{ Form::date('from', \Illuminate\Support\Carbon::now()->startOfMonth()->format('Y-m-d')) }}</td>
                <td>{{ Form::date('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>

            <tr>
                {{ Form::open(['route' => 'reports.sold-price-groups', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Звіт по продажу квитків за <b>день</b> у розрізі цін</td>
                <td>{{ Form::hidden('from', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::hidden('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>
            <tr>
                {{ Form::open(['route' => 'reports.sold-price-groups', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Звіт по продажу квитків за <b>період</b> у розрізі цін</td>
                <td>{{ Form::date('from', \Illuminate\Support\Carbon::now()->startOfMonth()->format('Y-m-d')) }}</td>
                <td>{{ Form::date('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>

            <tr>
                {{ Form::open(['route' => 'reports.event-tickets-sold', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Звіт по продажу квитків за <b>день</b> по виступам</td>
                <td>{{ Form::hidden('from', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::hidden('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>
            <tr>
                {{ Form::open(['route' => 'reports.event-tickets-sold', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Звіт по продажу квитків за <b>період</b> по виступам</td>
                <td>{{ Form::date('from', \Illuminate\Support\Carbon::now()->startOfMonth()->format('Y-m-d')) }}</td>
                <td>{{ Form::date('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>

            <tr>
                {{ Form::open(['route' => 'reports.event-tickets-sold', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Звіт по продажу квитків онлайн за <b>день</b> по виступам</td>
                <td>{{ Form::hidden('from', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::hidden('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                {{ Form::hidden('param', 'online') }}
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>
            <tr>
                {{ Form::open(['route' => 'reports.event-tickets-sold', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Звіт по продажу квитків онлайн за <b>період</b> по виступам</td>
                <td>{{ Form::date('from', \Illuminate\Support\Carbon::now()->startOfMonth()->format('Y-m-d')) }}</td>
                <td>{{ Form::date('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                {{ Form::hidden('param', 'online') }}
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>

            <tr>
                {{ Form::open(['route' => 'reports.detailed-sold', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Детальний звіт по продажу квитків за <b>день</b></td>
                <td>{{ Form::hidden('from', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                <td>{{ Form::hidden('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                {{ Form::hidden('param', 'online') }}
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>
            <tr>
                {{ Form::open(['route' => 'reports.detailed-sold', 'id' => 'form-report', 'method' => 'GET']) }}
                <td>Детальний звіт по продажу квитків за <b>період</b></td>
                <td>{{ Form::date('from', \Illuminate\Support\Carbon::now()->startOfMonth()->format('Y-m-d')) }}</td>
                <td>{{ Form::date('to', \Illuminate\Support\Carbon::now()->format('Y-m-d')) }}</td>
                {{ Form::hidden('param', 'online') }}
                <td>{{ Form::submit('Сформувати', ['class' => 'btn btn-success']) }}</td>
                {{ Form::close() }}
            </tr>
        @endcan
    </table>

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
    {!! Html::style('css/kasir.css') !!}
@endsection

@section('scripts')

@endsection