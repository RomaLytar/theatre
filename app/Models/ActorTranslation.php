<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class ActorTranslation extends Model
{
  use Sluggable;

  protected $fillable = ['actor_id', 'language', 'firstName', 'lastName', 'patronymic', 'descriptions', 'degree', 'repertoire', 'debut', 'hometown', 'merit', 'seo_title', 'seo_description', 'position'];

  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'fullname',
      ]
    ];
  }

  public function getFullnameAttribute() {
    return $this->lastName . ' ' . $this->firstName .' '. $this->patronymic;
  }

  public function getFLnameAttribute(){
    return $this->firstName . ' ' . $this->lastName;
  }
}
