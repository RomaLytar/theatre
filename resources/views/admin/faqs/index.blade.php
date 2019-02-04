@extends('layouts.admin')
@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.faqs') }}</h2>
        <div class="fsh">
            @can('faq-category-list')
                <a class="btn btn-primary" href="{{ route('faqs-categories.index') }}">{{ __('admin.faq_cat') }}</a>
            @endcan
            @can('faq-create')
                <a class="btn btn-success" href="{{ route('faqs.create') }}">{{ __('admin.c_new_faq') }}</a>
            @endcan
        </div>
    </div>


    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.title') }}</th>
            <th>{{ __('admin.description') }}</th>
            <th>{{ __('admin.cat') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($faqs as $faq)
            <tr>
                <td class="global__table-short">{{ $faq->id }}</td>
                <td>{{ $faq->translate->title }}</td>
                <td>{{ str_limit($faq->translate->description, 100) }}</td>
                <td>{{ $faq->category->translate->title }}</td>
                <td class="global__table-short">
                    @can('faq-edit')
                        <a class="btn btn-primary" href="{{ route('faqs.edit',$faq->id) }}"><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('faq-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['faqs.destroy', $faq->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
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
