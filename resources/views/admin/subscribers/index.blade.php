@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h1 class="global__page-title">{{ __('admin.subscribersManagement') }}</h1>
  </div>

  @include('admin.message')

  <table class="table table-bordered global__table">
    <tr>
      <th class="global__table-short">ID</th>
      <th>Email</th>
      <th>{{ __('admin.status') }}</th>
      <th class="global__table-short">{{ __('admin.action') }}</th>
    </tr>
    @foreach ($subscribers as $key => $subscriber)
      <tr>
        <td class="global__table-short">{{ $subscriber->id }}</td>
        <td>{{ $subscriber->email }}</td>
        <td>{{ $subscriber->status() }}</td>
        <td class="global__table-short">
          @can('subscriber-delete')
            {{ Form::open(['method' => 'DELETE', 'route' => ['subscribers.destroy', $subscriber->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
            {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
            {{ Form::close() }}
          @endcan
        </td>
      </tr>
    @endforeach
  </table>

  {!! $subscribers->links() !!}

@endsection

@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
  {!! Html::script('js/admin/global.js') !!}
@stop
