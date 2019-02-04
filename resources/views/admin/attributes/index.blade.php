@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h2 class="global__page-title">{{ __('admin.attributesManagement') }}</h2>
    <div class="fsh">
      {{--@can('album-create')--}}
        <a class="btn btn-success" href="{{ route('attributes.create') }}">{{ __('admin.createNewAttribute') }}</a>
      {{--@endcan--}}
    </div>
  </div>

  @include('admin.message')

  <table class="table table-bordered global__table">
    <tr>
      <th class="global__table-short">ID</th>
      <th>Name</th>
      <th class="global__table-short">Action</th>
    </tr>
    @foreach ($attributes as $key => $attribute)
      <tr>
        <td class="global__table-short">{{ $attribute->id }}</td>
        <td>{{ $attribute->name }}</td>
        <td class="global__table-short">
          {{--@can('permission-edit')--}}
          <a class="btn btn-primary" href="{{ route('attributes.edit',$attribute->id) }}"><i class="fa fa-pencil"></i></a>
          {{--@endcan--}}
          {{--@can('permission-delete')--}}
          {{ Form::open(['method' => 'DELETE', 'route' => ['attributes.destroy', $attribute->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
          {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
          {{ Form::close() }}
          {{--@endcan--}}
        </td>
      </tr>
    @endforeach
  </table>

  {!! $attributes->links() !!}

@endsection

@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
  {!! Html::script('js/admin/global.js') !!}
@stop
