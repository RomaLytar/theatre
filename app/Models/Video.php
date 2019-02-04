<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Url\Url;

class Video extends MultiLanguageModel implements HasMedia
{
  use HasMediaTrait;

  protected $fillable = ['url', 'category_id', 'season_id'];

  protected $multiLanguageForeignKey = 'video_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return VideoTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['title'];
  }

  public function registerMediaCollections()
  {
    $this->addMediaCollection('posters')->registerMediaConversions(function (Media $media) {
      $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 150, 150);
      $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 420, 275);
    });
  }

  public function actors()
  {
    return $this->belongsToMany(Actor::class, 'actor_videos');
  }


  public function performances()
  {
    return $this->belongsToMany(Performance::class, 'performance_videos');
  }

  public function category()
  {
    return $this->belongsTo(VideoCategory::class, 'category_id');
  }

  public function getImageUrlFromYoutube() {
    $url = Url::fromString($this->url);
    return $url->getQueryParameter('v');
  }
}
