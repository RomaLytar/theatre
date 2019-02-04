@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.pagesManagement') }}</h2>
        <div class="fsh">
            @can('attribute-list')
                <a class="btn btn-primary" href="{{ route('attributes.index') }}">{{ __('admin.attributes') }}</a>
            @endcan
            @can('page-create')
                <a class="btn btn-success" href="{{ route('pages.create') }}">{{ __('admin.createPage') }}</a>
            @endcan
        </div>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.title') }}</th>
            <th>{{ __('admin.url_adr') }}</th>
            <th class="global__table-short">{{ __('admin.poster') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($pages as $page)
            <tr>
                <td class="global__table-short">{{ $page->id }}</td>
                <td>{{ $page->translate->title }}</td>
                @if(route('front.pages.show', ['name' => $page->name]))
                    <td><a href="{{ route('front.pages.show', ['name' => $page->name]) }}">{{ $page->name }}</a></td>
                @else
                    <td>{{ $page->name }} - Page not found. Contact with programmers.</td>
                @endif
                <td class="global__table-short">
                    <img src="{{ $page->getFirstMediaUrl('posters', 'thumb') }}" alt="{{ $page->translate->title }}"
                         class="global__table-preview">
                </td>
                <td class="global__table-short">
                    @can('page-edit')
                        <a class="btn btn-small btn-primary" href="{{ route('pages.edit',$page->id) }}"><i
                                    class="fa fa-pencil"></i></a>
                    @endcan
                    @can('page-delete')
                        {{ Form::open(['method' => 'DELETE', 'route' => ['pages.destroy', $page->id], 'data-confirm' => 'Are you sure you want to delete?', 'style' => 'display:inline-block' ])}}
                        {{ Form::button("<i class=\"fa fa-trash\"></i>", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $pages->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', "form[data-confirm] button[type='submit']", function (e) {
                e.preventDefault();
                let button = $(this);
                let form = button.closest('form');
                let msg = form.data('confirm');
                if (confirm(msg)) form.submit();
            })
        });
    </script>
@stop
