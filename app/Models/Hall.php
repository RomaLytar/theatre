<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Hall extends multiLanguageModel implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['spaciousness', 'name'];
    protected $multiLanguageForeignKey = 'hall_id';
    protected $multiLanguageLocalKey = 'id';

    public function multiLanguageModel()
    {
        return HallTranslation::class;
    }

    public function multiLanguageFields()
    {
        return ['title', 'description'];
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('posters')->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 150, 150);
            $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 320, 215);
            $this->addMediaConversion('preview-mob')->fit(Manipulations::FIT_CROP, 450, 302);
            $this->addMediaConversion('medium')->fit(Manipulations::FIT_CROP, 812, 410);
        });
        $this->addMediaCollection('hall-images')->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 330, 320);
            $this->addMediaConversion('preview-big')->fit(Manipulations::FIT_CROP, 800, 600);
        });
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'hall_id');
    }
}
