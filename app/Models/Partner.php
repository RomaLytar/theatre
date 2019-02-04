<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Partner extends MultiLanguageModel implements HasMedia
{
  use HasMediaTrait;

  protected $fillable = ['category_id', 'is_active', 'in_footer', 'is_main', 'is_middle', 'url', 'url_partner'];
  protected $multiLanguageForeignKey = 'partner_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return PartnerTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['title', 'description'];
  }

  public function registerMediaCollections()
  {
    $this->addMediaCollection('posters')->registerMediaConversions(function (Media $media) {
      $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 150, 150);
      $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 440, 290);
    });
  }

  public function category()
  {
    return $this->belongsTo(PartnerCategory::class, 'category_id');
  }

//  public function get
}
