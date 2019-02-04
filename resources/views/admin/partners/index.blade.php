@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.partnersManagement') }}</h2>
        <div class="fsh">
            @can('partner-create')
                <a class="btn btn-primary"
                   href="{{ route('partner-categories.index') }}">{{ __('admin.partnerCategories') }}</a>
            @endcan
            @can('partner-category-list')
                <a class="btn btn-success" href="{{ route('partners.create') }}">{{ __('admin.createPartner') }}</a>
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
            <th class="global__table-short">{{ __('admin.poster') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($partners as $partner)
            <tr>
                <td class="global__table-short">{{ $partner->id }}</td>
                <td>{{ $partner->translate->title }}</td>
                <td>{!! str_limit($partner->translate->descriptions, 100) !!}</td>
                <td>{{ $partner->category->translate->title }}</td>
                <td class="global__table-short"><img src="{{ $partner->getFirstMediaUrl('posters', 'thumb') }}"
                                                     alt="{{ $partner->translate->title }}"
                                                     class="global__table-preview"></td>
                <td class="global__table-short">
                    @can('partner-edit')
                        <a class="btn btn-primary" href="{{ route('partners.edit',$partner->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('partner-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['partners.destroy', $partner->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $partners->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
