@extends('layouts.admin')

@section('content')
    <div class="df mb15">
        <h2 class="global__page-title">{{ __('admin.hall_plans') }}</h2>
    </div>

    @include('admin.message')

    <table class="table table-bordered global__table">
        <tr>
            <th class="global__table-short">ID</th>
            <th>{{ __('admin.title') }}</th>
            <th>{{ __('admin.description') }}</th>
            <th>{{ __('admin.spaciousness') }}</th>
            <th class="global__table-short">{{ __('admin.poster') }}</th>
            <th class="global__table-short">{{ __('admin.action') }}</th>
        </tr>
        @foreach ($halls as $hall)
            <tr>
                <td class="global__table-short">{{ $hall->id }}</td>
                <td>{{ $hall->translate->title }}</td>
                <td>{!! $hall->translate->description !!}</td>
                <td>{{ $hall->spaciousness }}</td>
                <td class="global__table-short"><img src="{{ $hall->getFirstMediaUrl('posters','thumb') }}" alt=""
                                                     class="global__table-preview"></td>
                <td class="global__table-short">
                    @if($hall->name !== 'outdoor')
                        @can('hall-seat-best-choice-edit')
                            <a class="btn btn-info" href="{{ route('halls.show', $hall->id) }}"><i
                                        class="fa fa-cog"></i> Кращий вибір</a>
                        @endcan
                        @can('hall-seat-image-edit')
                            <a class="btn btn-info" href="{{ route('halls.show-images', $hall->id) }}"><i
                                        class="fa fa-cog"></i> Фото місць</a>
                        @endcan
                    @endif
                    @can('hall-edit')
                        <a class="btn btn-primary" href="{{ route('halls.edit', $hall->id) }}"><i
                                    class="fa fa-pencil"></i></a>
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
