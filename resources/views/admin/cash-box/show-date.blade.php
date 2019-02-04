@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h1 class="global__page-title">Вибір квитків події " {{ $performanceCalendar->performance->translate->title }}
            "</h1>
        <div class="">
            <p><b>Дата та час:</b> {{ $performanceCalendar->getFormatDateTime() }}</p>
            <p><b>Зал:</b> {{ $performanceCalendar->performance->hall->translate->title }}</p>
        </div>
        <div class="fsh">
            <a class="btn btn-primary" href="{{ url()->previous() }}">Повернутися назад</a>
        </div>
    </div>

    @include('admin.message')

    <div class="kasir" id="kasir-price">
        <div class="kasir__alert-wrap"></div>

        <div class="kasir__scheme">
            <div class="kasir__scheme-svg">
                @include($performanceCalendar->performance->hall->patternPath, ['type' => 'scheme'])
            </div>
            <div class="kasir__scheme-btns">
                <button class="btn btn-success" type="button" id="saveSeats">Сохранить</button>
                <div class="kasir__scheme-controls">
                    <button class="btn btn-primary" type="button" id="zoom-in">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 52.966 52.966"
                             fill="#fff">
                            <path d="M28.983,20h-6v-6c0-0.552-0.448-1-1-1s-1,0.448-1,1v6h-6c-0.552,0-1,0.448-1,1s0.448,1,1,1h6v6c0,0.552,0.448,1,1,1
                        s1-0.448,1-1v-6h6c0.552,0,1-0.448,1-1S29.535,20,28.983,20z"/>
                            <path d="M51.704,51.273L36.845,35.82c3.79-3.801,6.138-9.041,6.138-14.82c0-11.58-9.42-21-21-21s-21,9.42-21,21s9.42,21,21,21
                        c5.083,0,9.748-1.817,13.384-4.832l14.895,15.491c0.196,0.205,0.458,0.307,0.721,0.307c0.25,0,0.499-0.093,0.693-0.279
                        C52.074,52.304,52.086,51.671,51.704,51.273z M2.983,21c0-10.477,8.523-19,19-19s19,8.523,19,19s-8.523,19-19,19
                        S2.983,31.477,2.983,21z"/>
                        </svg>
                    </button>
                    <button class="btn btn-danger" type="button" id="zoom-reset">Сбросить</button>
                    <button class="btn btn-warning" type="button" id="zoom-out">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52.966 52.966" width="20" height="20"
                             fill="#fff">
                            <path d="M28.983,20h-14c-0.552,0-1,0.448-1,1s0.448,1,1,1h14c0.552,0,1-0.448,1-1S29.535,20,28.983,20z"/>
                            <path d="M51.704,51.273L36.845,35.82c3.79-3.801,6.138-9.041,6.138-14.82c0-11.58-9.42-21-21-21s-21,9.42-21,21s9.42,21,21,21
                        c5.083,0,9.748-1.817,13.384-4.832l14.895,15.491c0.196,0.205,0.458,0.307,0.721,0.307c0.25,0,0.499-0.093,0.693-0.279
                        C52.074,52.304,52.086,51.671,51.704,51.273z M2.983,21c0-10.477,8.523-19,19-19s19,8.523,19,19s-8.523,19-19,19
                        S2.983,31.477,2.983,21z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="kasir__prices">
            <h2 class="kasir__prices-title"></h2>
            <ul class="kasir__prices-list"></ul>
        </div>
    </div>

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
    {!! Html::style('css/kasir.css') !!}
@endsection

@section('scripts')
    <script>
        window.csrf_token = `{{ csrf_token() }}`
    </script>
    {!! Html::script('js/plugins/svg-pan-zoom.js') !!}
    {!! Html::script('js/admin/kasir.js') !!}
@stop
