<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Ebook extends multiLanguageModel implements HasMedia
{
  use HasMediaTrait;

  protected $multiLanguageForeignKey = 'ebook_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return EbookTranslation::class;
  }
  public function multiLanguageFields()
  {
    return ['title'];
  }
    public function registerMediaCollections()
  {
    $this->addMediaCollection('posters')->registerMediaConversions(function (Media $media) {
      $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 150, 150);
      $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 405);
    });
  }
}
