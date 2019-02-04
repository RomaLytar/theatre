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
      <div class="col-md-12 form-group">
        <div class="file-load" data-file>
          <label class="file-load__label">
            {{Form::file('descriptions_old_' . $block->id, ['class'=>'visually-hidden', 'data-file-input', 'accept'=>'application/pdf'])}}
            <span class="file-load__text">{{ __('admin.add_file') }}</span>
          </label>

          <div class="file-load__list" data-file-list>
            @if($block->translate('en')->first()->descriptions !== '')
              <ul>
                <li>
                  <div>
                    <svg viewBox="0 0 60 60" width="60" height="60" xmlns="http://www.w3.org/2000/svg">
                      <path d="m42.5 22h-25c-0.552 0-1 0.447-1 1s0.448 1 1 1h25c0.552 0 1-0.447 1-1s-0.448-1-1-1z"/>
                      <path d="m17.5 16h10c0.552 0 1-0.447 1-1s-0.448-1-1-1h-10c-0.552 0-1 0.447-1 1s0.448 1 1 1z"/>
                      <path d="m42.5 30h-25c-0.552 0-1 0.447-1 1s0.448 1 1 1h25c0.552 0 1-0.447 1-1s-0.448-1-1-1z"/>
                      <path d="m42.5 38h-25c-0.552 0-1 0.447-1 1s0.448 1 1 1h25c0.552 0 1-0.447 1-1s-0.448-1-1-1z"/>
                      <path d="m42.5 46h-25c-0.552 0-1 0.447-1 1s0.448 1 1 1h25c0.552 0 1-0.447 1-1s-0.448-1-1-1z"/>
                      <path d="M38.914,0H6.5v60h47V14.586L38.914,0z M39.5,3.414L50.086,14H39.5V3.414z M8.5,58V2h29v14h14v42H8.5z"/>
                    </svg>
                  </div>
                  <button type="button" class="btn btn-danger" data-file-remove="true">
                    <span class="fa fa-trash"></span>
                  </button>
                </li>
              </ul>
            @endif
          </div>

          <button type="button" class="btn btn-success" data-file-btn>
            <span class="glyphicon glyphicon-download-alt"></span> {{ __('admin.add_file') }}
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <button type="button" class="btn btn-danger" data-btn-remove><i class="fa fa-trash"></i></button>
      </div>
    </div>
  </div>
</section>
