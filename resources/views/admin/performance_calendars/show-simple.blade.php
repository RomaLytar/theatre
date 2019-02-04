@extends('layouts.admin')

@section('content')
  <div data-distributors-tickets>
    <div class="df mb15">
        <h1 class="global__page-title">Редагування доступності місць події</h1>
        <div class="">
            <p><b>Назва події:</b> {{ $performanceCalendar->performance->translate->title }}</p>
            <p><b>Дата та час:</b> {{ $performanceCalendar->getFormatDateTime() }}</p>
            <p><b>Доступна кількість квитків:</b> <span data-total-tickets>{{ $performanceCalendar->tickets->count() }}</span></p>
            <p><b>Кількість квитків, що уже передана дистриб'юторам:</b> {{ $performanceCalendar->tickets()->where('distributor_id', '!=', null)->count() }}</p>
            <p><b>Кількість квитків, що не передані дистриб'юторам:</b> {{ $performanceCalendar->tickets->count() - $performanceCalendar->tickets()->where('distributor_id', '!=', null)->count() }}</p>
        </div>
        <div class="fsh">
            <a class="btn btn-primary" href="{{ url()->previous() }} }}">Повернутися назад</a>
        </div>
    </div>

    @include('admin.message')

    {{ Form::model($performanceCalendar, ['route' => array('performanceCalendar.updateDateTicketsSimple', $performanceCalendar->id), 'data-distributors-form', 'method' => 'PUT']) }}
    <div class="row">
        @foreach($distributors as $distributor)
            <div class="col-md-6 form-group">
                {{ Form::label('tickets_count_' . $distributor->id, $distributor->title) }}
                {{ Form::number('tickets_count_' . $distributor->id, $performanceCalendar->tickets()->where('distributor_id', $distributor->id)->count(), ['class' => 'form-control', 'data-distributor-input', 'max' => $performanceCalendar->tickets->count()]) }}
            </div>
        @endforeach
    </div>
    {{ Form::submit('Зберегти', ['class' => 'btn btn-success']) }}
    {{ Form::close() }}
  </div>
@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
    {!! Html::style('css/kasir.css') !!}
@endsection

@section('scripts')
  <script>
    window.csrf_token = `{{csrf_token()}}`
  </script>
  {!! Html::script('js/plugins/svg-pan-zoom.js') !!}
  {!! Html::script('js/admin/kasir.js') !!}
@stop
