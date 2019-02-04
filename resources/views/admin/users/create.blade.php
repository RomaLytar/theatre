@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h1 class="global__page-title">{{ __('admin.createNewUser') }}</h1>
        <div class="fsh">
            <a class="btn btn-primary" href="{{ route('users.index') }}">{{ __('admin.back') }}</a>
        </div>
    </div>

    @include('admin.errors')

    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="login">Логін:</label>
            {!! Form::text('login', null, ['class' => 'form-control', 'id' => 'login']) !!}
        </div>
        <div class="col-md-6 form-group">
            <label for="email">Email:</label>
            {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
        </div>
        <div class="col-md-6 form-group">
            <label for="password">Пароль:</label>
            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
        </div>
        <div class="col-md-6 form-group">
            <label for="password-confirm">Підтвердити пароль:</label>
            {!! Form::password('confirm-password', ['class' => 'form-control', 'id' => 'password-confirm']) !!}
        </div>
        <div class="col-md-6 form-group">
            <label for="lastName">Прізвище:</label>
            {!! Form::text('lastName', null, ['class' => 'form-control', 'id' => 'lastName']) !!}
        </div>
        <div class="col-md-6 form-group">
            <label for="firstName">Ім'я:</label>
            {!! Form::text('firstName', null, ['class' => 'form-control', 'id' => 'firstName']) !!}
        </div>
        <div class="col-md-6 form-group">
            <label for="phone">Телефон:</label>
            {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone']) !!}
        </div>
        <div class="col-md-6 form-group">
            <label for="country_id">Країна:</label>
            {!! Form::select('country_id', $countries, null, ['class' => 'form-control', 'id' => 'country_id']) !!}
        </div>
        <div class="col-md-6 form-group">
            <label for="city">Місто:</label>
            {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city']) !!}
        </div>
        <div class="col-md-6 form-group">
            <label for="street">Вулиця:</label>
            {!! Form::text('street', null, ['class' => 'form-control', 'id' => 'street']) !!}
        </div>
        <div class="col-md-6 form-group">
            <label for="houseNumber">Номер будинку:</label>
            {!! Form::text('houseNumber', null, ['class' => 'form-control', 'id' => 'houseNumber']) !!}
        </div>
        <div class="col-md-6 form-group">
            <label for="role">Ролі:</label>
            {!! Form::select('roles[]', $roles, [], array('class' => 'form-control','multiple', 'id' => 'role')) !!}
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Створити</button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection
