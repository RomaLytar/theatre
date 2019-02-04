<div class="performance-date row" data-perfomance-date-row>
  <div class="form-group col-md-6">
    {{ Form::label('performance_dates', __('performance.performanceDate')) }}
    <div class='input-group date input-date-perfomance' id='datetimepicker1'>
      <button type="button" class="btn btn-danger" data-date-remove="true">
        <span class="fa fa-trash"></span>
      </button>
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
      </span>
      {{ Form::text('performance_date', null, ['class' => 'form-control']) }}
    </div>
  </div>
  <div class="form-group col-md-6">
    {{ Form::label('special_actors', __('performance.specialActors')) }}
    <select name="special_actors[]" class="form-control">
    </select>
  </div>
</div>
