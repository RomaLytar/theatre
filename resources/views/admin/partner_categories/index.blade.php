@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h1 class="global__page-title">{{ __('admin.partnerCategoriesManagement') }}</h1>
        <div class="fsh">
            @can('partner-category-create')
                <a class="btn btn-success"
                   href="{{ route('partner-categories.create') }}">{{ __('admin.createNewPartnerCategory') }}</a>
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
        @foreach ($partnerCategories as $key => $partnerCategory)
            <tr>
                <td class="global__table-short">{{ $partnerCategory->id }}</td>
                <td>{{ $partnerCategory->translate->title }}</td>
                <td class="global__table-short">
                    @can('partner-category-edit')
                        <a class="btn btn-primary" href="{{ route('partner-categories.edit',$partnerCategory->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('partner-category-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['partner-categories.destroy', $partnerCategory->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $partnerCategories->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
