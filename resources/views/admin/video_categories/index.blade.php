@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h2 class="global__page-title">{{ __('admin.videoCategoriesManagement') }}</h2>
    <div class="fsh">
      @can('video-create')
          <a class="btn btn-success" href="{{ route('video-categories.create') }}">{{ __('admin.createNewVideoCategory') }}</a>
        @endcan
    </div>
  </div>

  @include('admin.message')

  <table class="table table-bordered global__table">
    <tr>
      <th class="global__table-short">ID</th>
      <th>{{ __('admin.name') }}</th>
      <th class="global__table-short">{{ __('admin.action') }}</th>
    </tr>
    @foreach ($videoCategories as $key => $videoCategory)
      <tr>
        <td class="global__table-short">{{ $videoCategory->id }}</td>
        <td>{{ $videoCategory->translate->title }}</td>
        <td class="global__table-short">
          @can('video-edit')
            <a class="btn btn-primary" href="{{ route('video-categories.edit',$videoCategory->id) }}"><i class="fa fa-pencil"></i></a>
          @endcan
          @can('video-delete')
          {{ Form::open(['method' => 'DELETE', 'route' => ['video-categories.destroy', $videoCategory->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
          {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
          {{ Form::close() }}
          @endcan
        </td>
      </tr>
    @endforeach
  </table>

  {!! $videoCategories->links() !!}

@endsection

@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
  {!! Html::script('js/admin/global.js') !!}
@stop
