@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">Управління пожертвами</h1>
  </div>

  @include('admin.message')

  <table class="table table-bordered global__table">
    <tr>
      <th class="global__table-short">ID</th>
      <th>Прізвище, ім'я</th>
      <th>Телефон</th>
      <th>Сума пожертви</th>
      <th>Коментар</th>
      <th>Дата/час</th>
      <th>Статус транзакції</th>
    </tr>
    @foreach ($donations as $donation)
      <tr style="background-color: {{ $donation->payment_status === 'success' ? '#98FB98' : '#F08080' }}">
        <td class="global__table-short">{{ $donation->id }}</td>
        <td>{{ $donation->fullName() }}</td>
        <td>{{ $donation->phone }}</td>
        <td>{{ $donation->amount }}</td>
        <td>{{ $donation->comment }}</td>
        <td>{{ $donation->date_time }}</td>
        <td>{{ $donation->payment_status }}</td>
      </tr>
    @endforeach
  </table>

  {!! $donations->links() !!}

@endsection

@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
  {!! Html::script('js/admin/global.js') !!}
@stop
