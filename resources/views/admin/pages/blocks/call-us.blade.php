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
    <div class="tab-content" data-tab-parent>
      <div role="tabpanel" class="tab-pane active" data-id="en">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_en_old_' . $block->id, __('page.title')) }}
            {{ Form::text('title_en_old_' . $block->id, $block->translate('en')->first()->title ?? Input::old('title_en_old_' . $block->id), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-12 form-group">
            {{ Form::label('descriptions_en_old_' . $block->id, __('page.descriptions')) }}
            {{ Form::textarea('descriptions_en_old_' . $block->id, $block->translate('en')->first()->descriptions ?? Input::old('descriptions_en_old_' . $block->id), ['class' => 'form-control', 'data-ckeditor', 'data-ckeditor']) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" data-id="ru">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ru_old_' . $block->id, __('page.title')) }}
            {{ Form::text('title_ru_old_' . $block->id, $block->translate('ru')->first()->title ?? Input::old('title_ru_old_' . $block->id), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-12 form-group">
            {{ Form::label('descriptions_ru_old_' . $block->id, __('page.descriptions')) }}
            {{ Form::textarea('descriptions_ru_old_' . $block->id, $block->translate('ru')->first()->descriptions ?? Input::old('descriptions_ru_old_' . $block->id), ['class' => 'form-control', 'data-ckeditor', 'data-ckeditor']) }}
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" data-id="ua">
        <div class="row">
          <div class="col-md-6 form-group">
            {{ Form::label('title_ua_old_' . $block->id, __('page.title')) }}
            {{ Form::text('title_ua_old_' . $block->id, $block->translate('ua')->first()->title ?? Input::old('title_ua_old_' . $block->id), ['class' => 'form-control' ]) }}
          </div>
          <div class="col-md-12 form-group">
            {{ Form::label('descriptions_ua_old_' . $block->id, __('page.descriptions')) }}
            {{ Form::textarea('descriptions_ua_old_' . $block->id, $block->translate('ua')->first()->descriptions ?? Input::old('descriptions_ua_old_' . $block->id), ['class' => 'form-control', 'data-ckeditor', 'data-ckeditor']) }}
          </div>
        </div>
      </div>
    </div>
    <div class="row" data-panel-parent>
      <div class="col-md-12 form-group">
        <div class="file-load" data-file>
          <label class="file-load__label">
            <input type="file" name="poster_old_{{ $block->id }}" class="visually-hidden" id="photo_{{ $block->id }}" accept='image/*' data-file-input>
            <span class="file-load__text">Image</span>
          </label>
          <div class="file-load__list" data-file-list>
            @if($block->getFirstMediaUrl('posters', 'thumb'))
              <ul>
                <li>
                  <img src="{{ $block->getFirstMediaUrl('posters', 'thumb') }}" alt="photo">
                  <button type="button" class="btn btn-danger" data-file-remove="true">
                    <span class="fa fa-trash"></span>
                  </button>
                </li>
              </ul>
            @endif
          </div>
          <button type="button" class="btn btn-success" data-file-btn>
            <span class="glyphicon glyphicon-download-alt"></span> Add img...
          </button>
        </div>
      </div>
      <div class="col-md-12">
        <button type="button" class="btn btn-danger" data-btn-remove>
          <i class="fa fa-trash"></i>
        </button>
      </div>
    </div>
  </div>
</section>
