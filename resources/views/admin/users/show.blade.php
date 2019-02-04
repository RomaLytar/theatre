@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{ __('admin.showUser') }}</h1>
    <div class="fsh">
      <a class="btn btn-primary" href="{{ route('users.index') }}">{{ __('admin.back') }}</a>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 form-group">
      <strong>Логін:</strong>
      {{ $user->login }}
    </div>
    <div class="col-xs-12 form-group">
      <strong>Email:</strong>
      {{ $user->email }}
    </div>
    <div class="col-xs-12 form-group">
      <strong>Прізвище:</strong>
      {{ $user->lastName }}
    </div>
    <div class="col-xs-12 form-group">
      <strong>Ім'я:</strong>
      {{ $user->firstName }}
    </div>
    <div class="col-xs-12 form-group">
      <strong>Телефон:</strong>
      {{ $user->phone }}
    </div>
    <div class="col-xs-12 form-group">
      <strong>Країна:</strong>
      {{ $user->country->translate->title ?? 'Не вказана' }}
    </div>
    <div class="col-xs-12 form-group">
      <strong>Місто:</strong>
      {{ $user->city }}
    </div>
    <div class="col-xs-12 form-group">
      <strong>Вулиця:</strong>
      {{ $user->street }}
    </div>
    <div class="col-xs-12 form-group">
      <strong>Номер будинку:</strong>
      {{ $user->houseNumber }}
    </div>
    <div class="col-xs-12 form-group">
      <strong>Статус:</strong>
      {{ $user->confirmed ? 'Підтвердив обліковий запис' : 'Непідтверджений' }}
    </div>

    <div class="col-xs-12 form-group">
      <strong>Ролі:</strong>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $role)
          <span class="badge badge-success">{{ $role }}</span>
        @endforeach
      @endif
    </div>
  </div>

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection
