@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h2 class="global__page-title">{{ __('admin.doc_cat') }}</h2>
    <div class="fsh">
      {{--@can('album-create')--}}
        <a class="btn btn-success" href="{{ route('documentation-categories.create') }}">{{ __('admin.create_new_cet_doc') }} </a>
      {{--@endcan--}}
    </div>
  </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.name') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($documentationCategories as $key => $documentationCategory)
            <tr>
                <td class="global__table-short">{{ $documentationCategory->id }}</td>
                <td><a href="{{ route('front.docs.index', ['id' => $documentationCategory->id,'slug' => $documentationCategory->translate->slug]) }}">{{ $documentationCategory->translate->title }}</a></td>
                <td class="global__table-short">
                    {{--@can('permission-edit')--}}
                    <a class="btn btn-primary" href="{{ route('documentation-categories.edit',$documentationCategory->id) }}"><i class="fa fa-pencil"></i></a>
                    {{--@endcan--}}
                    {{--@can('permission-delete')--}}
                    {{ Form::open(['method' => 'DELETE', 'route' => ['documentation-categories.destroy', $documentationCategory->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                    {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                    {{ Form::close() }}
                    {{--@endcan--}}
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
