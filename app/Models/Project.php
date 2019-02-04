<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Project extends MultiLanguageModel implements HasMedia
{
  use HasMediaTrait;
  protected $table = 'projects';
  protected $fillable = ['category_id'];
  protected $multiLanguageForeignKey = 'project_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return ProjectTranslation::class;
  }
  public function multiLanguageFields()
  {
    return ['title','description'];
  }
  public function registerMediaCollections()
  {
    $this->addMediaCollection('posters')->registerMediaConversions(function (Media $media) {
      $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP, 150, 150);
      $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 420, 275);
    });
  }
  public function category()
  {
    return $this->belongsTo(ProjectCategory::class, 'category_id');
  }
  protected function project() {
    return $this->hasMany(Project::class, 'project_id', 'id');
  }
  public function shortDescription($сharacterNumber) {
    return str_limit($this->translate->description, $сharacterNumber);
  }
}
