@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.banners') }}</h2>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.title') }}</th>
            <th class="global__table-short">{{ __('admin.poster') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($banners as $banner)
            <tr>
                <td class="global__table-short">{{ $banner->id }}</td>
                <td>{{ $banner->translate->title }}</td>
                <td class="global__table-short"><img src="{{ $banner->getFirstMediaUrl('posters','thumb') }}" alt="{{ $banner->translate->title }}" class="global__table-preview"></td>
                <td class="global__table-short">
                    @can('banner-edit')
                        <a class="btn btn-primary" href="{{ route('banners.edit',$banner->id) }}"><i class="fa fa-pencil"></i></a>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $banners->links() !!}

@endsection

@section('styles')
    {!! Html::style('css/global.css') !!}
@endsection

@section('scripts')
    {!! Html::script('js/admin/global.js') !!}
@stop
