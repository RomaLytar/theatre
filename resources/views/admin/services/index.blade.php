@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h2 class="global__page-title">{{ __('admin.servicesManagement') }}</h2>
    <div class="fsh">
      @can('service-create')
        <a class="btn btn-success" href="{{ route('services.create') }}">{{ __('admin.create') }}</a>
      @endcan
    </div>
  </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.title') }}</th>
            <th>{{ __('admin.description') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($services as $service)
            <tr>
                <td class="global__table-short">{{ $service->id }}</td>
                <td>{{ $service->translate->title }}</td>
                <td>{{ $service->translate->description }}</td>
                <td class="global__table-short">
                    @can('service-edit')
                        <a class="btn btn-primary" href="{{ route('services.edit',$service->id) }}"><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('service-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['services.destroy', $service->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

@endsection

@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
  {!! Html::script('js/admin/global.js') !!}
@stop
