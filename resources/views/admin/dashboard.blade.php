@extends('layouts.admin')
@section('content')
    <h1>@lang('admin.dashboard')</h1>

    @include('admin.message')

    @can('tickets-sold')
        @if(\Auth::user()->leftoverDay())
            <div class="leftover">Сума каси на початок дня:
                <span>{{ \Auth::user()->leftoverDay()->start_sum . ' грн.' ?? 'не встановлена' }}</span>
            </div>
            <br>
        @endif
        @if(!\Auth::user()->leftoverDay())
            {{ Form::open(['route' => 'leftovers.store', 'files' => true, 'id' => 'leftover-create']) }}
            <div class="row">
                <div class="col-md-6 form-group">
                    {{ Form::label('start_sum', 'Введіть суму') }}
                    {{ Form::text('start_sum', 0, ['class' => 'form-control']) }}
                </div>
            </div>
        {{ Form::submit(__('admin.create'), ['class' => 'btn btn-success']) }}
        @endif
    @endcan
@endsection
