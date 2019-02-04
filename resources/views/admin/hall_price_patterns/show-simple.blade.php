@extends('layouts.admin')

@section('content')

    <div class="df mb15">
        <h1 class="global__page-title">Натягування цінового шаблону на схему залу: "{{ $hallPricePattern->hall->translate->title }}"</h1>
        <div class="">
            <p><b>Всього місць:</b> {{ $hallPricePattern->seats->count() }}</p>
            <p><b>Всього доступно місць для продажу:</b> {{ $hallPricePattern->availableSeats->count() }}</p>
            <p><b>Всього закрито місць для продажу:</b> {{ $hallPricePattern->unavailableSeats->count() }}</p>
        </div>
        <div class="fsh">
            <a class="btn btn-primary" href="{{ route('hall-price-patterns.index') }}">Повернутися назад</a>
        </div>
    </div>

    @include('admin.message')

    {{ Form::model($hallPricePattern, ['route' => array('hall-price-patterns.updateSeatPricesSimple', $hallPricePattern->id), 'method' => 'PUT']) }}
        <div>
            <div class="col-md-6 form-group">
                {{ Form::label('seats_count', 'Скільки місць зробити доступними для покупки? (Не більше ' . $hallPricePattern->seats->count() . ')') }}
                {{ Form::number('seats_count', $hallPricePattern->availableSeats->count(), ['class' => 'form-control', 'max' => $hallPricePattern->seats->count()]) }}
            </div>
            <div class="col-md-6 form-group">
                {{ Form::label('price_zone_id', 'Встановіть ціну квитків') }}
                {{ Form::select('price_zone_id', $priceZones, Input::old('price_zone_id'), ['class' => 'form-control']) }}
            </div>
        </div>
        {{ Form::submit('Зберегти', ['class' => 'btn btn-success']) }}
    {{ Form::close() }}

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
