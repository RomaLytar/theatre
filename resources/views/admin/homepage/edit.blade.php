@extends('layouts.admin')
@section('content')
  <div class="df mb15">
    <h2 class="global__page-title">{{__('admin.homepage')}}</h2>
  </div>

  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
      <a href="#promo-slider" aria-controls="promo-slider" role="tab" data-toggle="tab">
        {{ __('admin.promoSlider') }}
      </a>
    </li>
    <li role="presentation">
      <a href="#promo-slider-mini" aria-controls="promo-slider-mini" role="tab" data-toggle="tab">
        {{ __('admin.promoSliderMini') }}
      </a>
    </li>
    <li role="presentation">
      <a href="#recommended" aria-controls="recommended" role="tab" data-toggle="tab">
        {{ __('admin.recommended') }}
      </a>
    </li>
    <li role="presentation">
      <a href="#special-projects" aria-controls="special-projects" role="tab" data-toggle="tab">
        {{ __('admin.special_projects') }}
      </a>
    </li>
  </ul>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" data-name="promoSlider" id="promo-slider">
      <div class="form-group">
        <input type="search" name="q" class="form-control search-input" placeholder="Search" autocomplete="off">
      </div>
      <div class="performances df row jcst">
        @foreach($components as $component)
          @if($component->type === \App\Models\HomePage::PROMO_SLIDER_TYPE)
            <div class="w33 performance" data-id="{{$component->performance_calendar_id}}">
              <div class="row">
                <div class="col-md-4"><img class="img-thumbnail" src="{{ $component->performanceDate->performance->poster }}"/></div>
                <div class="col-md-8">
                  <p><strong>{{ $component->performanceDate->performance->translate->title }}</strong></p>
                  <p>{{$component->performanceDate->date}}</p>
                  <a class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>

    <div role="tabpanel" class="tab-pane" data-name="promoSliderMini" id="promo-slider-mini">
      <div class="form-group">
        <input type="search" name="q" class="form-control search-input"placeholder="Search" autocomplete="off">
      </div>
      <div class="performances df row jcst" data-maxItem="3">
        @foreach($components as $component)
          @if($component->type === \App\Models\HomePage::PROMO_SLIDER_MINI_TYPE)
            <div class="w33 performance" data-id="{{$component->performance_calendar_id}}">
              <div class="row">
                <div class="col-md-4"><img class="img-thumbnail" src="{{ $component->performanceDate->performance->poster }}"/></div>
                <div class="col-md-8">
                  <p><strong>{{ $component->performanceDate->performance->translate->title }}</strong></p>
                  <p>{{$component->performanceDate->date}}</p>
                  <a class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>

    <div role="tabpanel" class="tab-pane" data-name="recommended"  id="recommended">
      <div class="form-group">
        <input type="search" name="q" class="form-control search-input" placeholder="Search" autocomplete="off">
      </div>
      <div class="performances df row jcst" data-maxItem="4">
        @foreach($components as $component)
          @if($component->type === \App\Models\HomePage::RECOMMENDED_TYPE)
            <div class="w33 performance" data-id="{{$component->performance_calendar_id}}">
              <div class="row">
                <div class="col-md-4"><img class="img-thumbnail" src="{{ $component->performanceDate->performance->poster }}"/></div>
                <div class="col-md-8">
                  <p><strong>{{ $component->performanceDate->performance->translate->title }}</strong></p>
                  <p>{{$component->performanceDate->date}}</p>
                  <a class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>

    <div role="tabpanel" class="tab-pane" data-name="specialProjects" id="special-projects">
      <div class="form-group">
        <input type="search" name="q" class="form-control search-input" placeholder="Search" autocomplete="off">
      </div>
      <div class="performances df row jcst" data-maxItem="7">
        @foreach($components as $component)
          @if($component->type === \App\Models\HomePage::SPECIAL_PROJECTS_TYPE)
            <div class="w33 performance" data-id="{{$component->performance_calendar_id}}">
              <div class="row">
                <div class="col-md-4"><img class="img-thumbnail" src="{{ $component->performanceDate->performance->poster }}"/></div>
                <div class="col-md-8">
                  <p><strong>{{ $component->performanceDate->performance->translate->title }}</strong></p>
                  <p>{{$component->performanceDate->date}}</p>
                  <a class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>

    <div class="mt15">
      {{ Form::open(['url' => '/admin/homepage', 'method' => 'POST', 'id' => 'homepage-components']) }}
      {{ Form::submit(__('admin.save'), ['class' => 'btn btn-success']) }}
      {{ Html::link('admin/homepage', __('admin.cancel'), ['class' => 'btn btn-warning']) }}
    </div>

    @if (!empty($components))
      @foreach($components as $component)
        {{ Form::hidden(
          $component->type . '[]',
          $component->performance_calendar_id,
          ['id' => null, 'data-id' => $component->performance_calendar_id]
        ) }}
      @endforeach
    @endif
    {{ Form::close() }}
  </div>

@endsection
@section('styles')
  {!! Html::style('css/global.css') !!}
@endsection
@section('scripts')
  {!! Html::script('js/plugins/typeahead.bundle.min.js') !!}
  <script>
    $(document).ready(function() {
      let engine = new Bloodhound({
        remote: {
          url: '/admin/search/performance?q=%QUERY%',
          wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
      });
      $(".search-input").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      }, {
        source: engine.ttAdapter(),

        // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
        name: 'performanceList',

        // the key from the array we want to display (name,id,email,etc...)
        templates: {
          empty: [
            '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
          ],
          header: [
            '<div class="list-group search-results-dropdown">'
          ],
          suggestion: function (data) {
            return '<a href="#" class="list-group-item">' + data.title + '  - @' + data.date + '</a>'
          }
        },
        display: ''
      }).bind('typeahead:selected', function(obj, selected, name) {
        const parent = $('.tab-pane.active');
        const performancesBlock = parent.find('.performances');
        // if (parent.attr('id') === 'promo-slider') {
        //   performancesBlock.empty();
        //   $(`input[name="promoSlider[]"]`).remove();
        // }

        $(".search-input").typeahead('val', '');
        if (performancesBlock.attr('data-maxItem') <= performancesBlock.find('.performance').length) {
          alert('Max item: ' + performancesBlock.attr('data-maxItem'));
          return false;
        }
        const performance = `<div class="row performance" data-id="${selected.idDate}">` +
          `<div class="col-md-4"><img class="img-thumbnail" src="${selected.poster}"/></div>` +
          `<div class="col-md-8"><p><strong>${selected.title}</strong> <a class="pull-right btn btn-danger delete">Delete</a></p>`+
          `<p>${selected.date}</p></div>` +
          `</div>`;

        const input = `<input type="hidden" name="${parent.attr('data-name') + '[]'}" value="${selected.idDate}"/>`
        $('#homepage-components').append(input)
        performancesBlock.append(performance);
        return false;
      }).off('blur');

      $(document).on('click', '.delete', function () {
        const id = $(this).closest('.performance').attr('data-id');
        const name = $(this).closest('.tab-pane.active').attr('data-name');
        $(`input[data-id="${id}"][name="${name + '[]'}"]`).remove();
        $(this).closest('.performance').remove();
      })
    });
  </script>
@stop
