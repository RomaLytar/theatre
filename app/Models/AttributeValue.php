<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class AttributeValue extends MultiLanguageModel implements HasMedia
{
  use HasMediaTrait;

  protected $fillable = ['attribute_id', 'page_id', 'is_center'];
  protected $multiLanguageForeignKey = 'attribute_value_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return AttributeValueTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['title'];
  }

  public function registerMediaCollections()
  {
    $this->addMediaCollection('posters')->registerMediaConversions(function (Media $media) {
      $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 150, 150);
      $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 250, 250);
      $this->addMediaConversion('preview-mob')->fit(Manipulations::FIT_CROP, 630, 523);
    });
    $this->addMediaCollection('album-images')->registerMediaConversions(function (Media $media) {
      $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 150, 150);
      $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 430, 289);
      $this->addMediaConversion('preview-mini')->fit(Manipulations::FIT_CROP, 320, 215);
      $this->addMediaConversion('preview-mob')->fit(Manipulations::FIT_CROP, 450, 302);
    });
  }

  public function attribute() {
    return $this->hasOne(Attribute::class, 'id', 'attribute_id');
  }
}
