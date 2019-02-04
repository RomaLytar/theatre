<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Banner extends MultiLanguageModel implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['is_calendar'];
    protected $multiLanguageForeignKey = 'banner_id';
    protected $multiLanguageLocalKey = 'id';

    public function multiLanguageModel()
    {
        return BannerTranslation::class;
    }
    public function multiLanguageFields()
    {
        return ['title'];
    }
    public function registerMediaCollections()
    {
        $this->addMediaCollection('posters')->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 1600, 500);
            $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 150, 150);
        });
    }
}
