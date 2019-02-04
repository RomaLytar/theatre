@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.faq_cat') }}</h2>
        <div class="fsh">
            @can('faq-category-create')
                <a class="btn btn-success"
                   href="{{ route('faqs-categories.create') }}">{{ __('admin.create_new_faq') }}</a>
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
        @foreach ($faqCategories as $key => $faqCategory)
            <tr>
                <td class="global__table-short">{{ $faqCategory->id }}</td>
                <td>{{ $faqCategory->translate->title }}</td>
                <td class="global__table-short">
                    @can('faq-category-edit')
                        <a class="btn btn-primary" href="{{ route('faqs-categories.edit',$faqCategory->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('faq-category-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['faqs-categories.destroy', $faqCategory->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
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

