<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Album extends MultiLanguageModel implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['category_id', 'season_id'];
    protected $multiLanguageForeignKey = 'album_id';
    protected $multiLanguageLocalKey = 'id';

    public function multiLanguageModel()
    {
        return AlbumTranslation::class;
    }

    public function multiLanguageFields()
    {
        return ['title'];
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('posters')->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 150, 150);
            $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 430, 289);
            $this->addMediaConversion('preview-mini')->fit(Manipulations::FIT_CROP, 320, 215);
            $this->addMediaConversion('preview-mob')->fit(Manipulations::FIT_CROP, 480, 325);
        });
        $this->addMediaCollection('album-images')->registerMediaConversions(function (Media $media) {
          $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 320, 215);
        });
    }

    public function category()
    {
        return $this->belongsTo(AlbumCategory::class, 'category_id');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actor_albums');
    }

    public function performances()
    {
        return $this->belongsToMany(Performance::class, 'performance_albums');
    }

}
