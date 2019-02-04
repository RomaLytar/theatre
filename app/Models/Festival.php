<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Festival extends MultiLanguageModel implements HasMedia
{
    use HasMediaTrait;

    protected $multiLanguageForeignKey = 'festival_id';
    protected $multiLanguageLocalKey = 'id';
    protected $fillable = ['fb_link', 'tw_link', 'poster'];

    public function multiLanguageModel()
    {
        return 'App\Models\FestivalTranslation';
    }

    public function multiLanguageFields()
    {
        return ['title', 'descriptions', 'invited_stars'];
    }

    public function registerMediaCollections()
    {
      $this->addMediaCollection('posters')->registerMediaConversions(function (Media $media) {
        $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 150, 150);
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 420, 459);
      });
      $this->addMediaCollection('album-images')->registerMediaConversions(function (Media $media) {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 320, 215);
      });
    }

    public function calendars()
    {
        return $this->belongsToMany('App\Models\PerformanceCalendar', 'festival_calendars');
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'festival_images');
    }

    public function videos()
    {
        return $this->belongsToMany('App\Models\Video', 'festival_videos');
    }
}
