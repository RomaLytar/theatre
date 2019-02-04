<section class="panel panel-primary" data-panel-section>
  {{ Form::hidden('attribute_id_old_' . $block->id, $block->attribute_id) }}
  {{ Form::hidden('attribute_name_old_' . $block->id, $block->attribute->name) }}
  <div class="panel-heading">
    <h2 class="panel-title panel-section-title" data-block-number>Block {{ $i + 1 }} <span class="badge">{{ $block->attribute->name }}</span></h2>
  </div>
  <div class="panel-body">
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a data-href="en">EN</a></li>
      <li role="presentation"><a data-href="ru">RU</a></li>
      <li role="presentation"><a data-href="ua">UA</a></li>
    </ul>
    <div class="row">
      <div class="col-md-6">
        <div class="tab-content" data-tab-parent>
          <div role="tabpanel" class="tab-pane active" data-id="en">
            <div class="form-group">
              {{ Form::label('title_en_old_' . $block->id, __('admin.title')) }}
              {{ Form::text('title_en_old_' . $block->id, $block->translate('en')->first()->title ?? Input::old('title_en_old_' . $block->id), ['class' => 'form-control' ]) }}
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" data-id="ru">
            <div class="form-group">
              {{ Form::label('title_ru_old_' . $block->id, __('admin.title')) }}
              {{ Form::text('title_ru_old_' . $block->id, $block->translate('ru')->first()->title ?? Input::old('title_ru_old_' . $block->id), ['class' => 'form-control' ]) }}
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" data-id="ua">
            <div class="form-group">
              {{ Form::label('title_ua_old_' . $block->id, __('admin.title')) }}
              {{ Form::text('title_ua_old_' . $block->id, $block->translate('ua')->first()->title ?? Input::old('title_ua_old_' . $block->id), ['class' => 'form-control' ]) }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 form-group" style="margin-top: 10px">
        {{ Form::label('descriptions_old_' . $block->id, __('admin.map_coordinates')) }}
        {{ Form::text('descriptions_old_' . $block->id, $block->translate('en')->first()->descriptions ?? Input::old('descriptions_old_' . $block->id), ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <button type="button" class="btn btn-danger" data-btn-remove><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</section>
