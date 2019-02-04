@extends('layouts.admin')

@section('content')
  <div class="df mb15">
    <h2 class="global__page-title">{{ __('admin.ebooks') }}</h2>
    <div class="fsh">
      @can('e-book-create')
        <a class="btn btn-success" href="{{ route('ebooks.create') }}">{{ __('admin.create_new_ebook') }}</a>
      @endcan
    </div>
  </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.title') }}</th>
            <th class="global__table-short">{{ __('admin.poster') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($ebooks as $ebook)
            <tr>
                <td class="global__table-short">{{ $ebook->id }}</td>
                <td>{{ $ebook->translate->title }}</td>
                <td class="global__table-short"><img src="{{ $ebook->getFirstMediaUrl('posters','thumb') }}" alt="{{ $ebook->translate->title }}" class="global__table-preview"></td>
                <td class="global__table-short">
                    @can('e-book-edit')
                    <a class="btn btn-primary" href="{{ route('ebooks.edit',$ebook->id) }}"><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('e-book-delete')
                    {{ Form::open(['method' => 'DELETE', 'route' => ['ebooks.destroy', $ebook->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                    {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                    {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $ebooks->links() !!}

@endsection

@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
  {!! Html::script('js/admin/global.js') !!}
@stop
