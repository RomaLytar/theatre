<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Service extends multiLanguageModel implements HasMedia
{
  use HasMediaTrait;
  protected $multiLanguageForeignKey = 'service_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return ServiceTranslation::class;
  }
  public function multiLanguageFields()
  {
    return ['title','description'];
  }
  public function registerMediaCollections()
  {
    $this->addMediaCollection('service-images')->registerMediaConversions(function (Media $media) {
      $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 323, 346);
    });
  }
}
