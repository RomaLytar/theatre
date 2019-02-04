<?php

namespace App\Models;

use App;


use App\Models\PerformanceCalendar;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Jenssegers\Date\Date;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Actor extends MultiLanguageModel implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['dob', 'facebook', 'instagram', 'twitter', 'youtube', 'group_id', 'is_main'];
    protected $multiLanguageForeignKey = 'actor_id';
    protected $multiLanguageLocalKey = 'id';

    public function multiLanguageModel()
    {
      return ActorTranslation::class;
    }

    public function multiLanguageFields()
    {
      return ['firstName', 'lastName', 'descriptions', 'patronymic', 'degree', 'hometown', 'debut', 'merit', 'repertoire'];
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'actor_images');
    }

    public function albums()
    {
        return $this->belongsToMany('App\Models\Album', 'actor_albums');
    }

    public function videos()
    {
        return $this->belongsToMany('App\Models\Video', 'actor_videos');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\ActorGroup', 'group_id');
    }

    public function calendars() {
        return $this->hasMany(PerformanceActor::class, 'actor_id');
    }

    public function registerMediaCollections()
    {
      $this->addMediaCollection('posters')->registerMediaConversions(function (Media $media) {
        $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 150, 150);
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 420, 459);
        $this->addMediaConversion('mini')->fit(Manipulations::FIT_CROP, 300, 340);
        $this->addMediaConversion('preview_mob')->fit(Manipulations::FIT_CROP, 480, 325);
        $this->addMediaConversion('mini_mob')->fit(Manipulations::FIT_CROP, 330, 330);
      });
    }
    public function articles()
    {
      return $this->belongsToMany(Article::class, 'article_actors');
    }

    public function eventDatesList() {
      $dates = collect([]);
      foreach ($this->calendars as $calendar) {
        $dates->push($calendar->date);
      }
      return $dates->sortBy('date');
    }

    public function eventDaysList() {
      $dates =  $this->eventDatesList();
      $days = [];
      foreach ($dates as $date) {
        $days[] = Date::parse($date->date)->format('m.d.Y');
      }
      return implode(',', $days);
    }

    public function fullName() {
      return $this->translate->lastName. ' ' . $this->translate->firstName . ' ' . $this->translate->patronymic;
    }

    public function  FLName(){
      return $this->translate->firstName. ' ' . $this->translate->lastName;
    }

    public function getFLnameAttribute(){
      return $this->translate->firstName . ' ' . $this->translate->lastName;
    }

    public function getFullnameAttribute() {
      return $this->translate->lastName . ' ' . $this->translate->firstName . ' ' . $this->translate->patronymic;
    }

    public function roleName() {
      if(isset($this->role_id)) {
        return $this->belongsTo(ActorRole::class, 'role_id');
      }
      return null;
    }
}
