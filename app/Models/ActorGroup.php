<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActorGroup extends MultiLanguageModel
{
  protected $fillable = ['parent_id', 'is_active'];
  protected $multiLanguageForeignKey = 'actor_group_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return ActorGroupTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['title'];
  }

  public function actors() {
    return $this->hasMany(Actor::class, 'group_id', 'id');
  }

  public function main_actors() {
    return $this->hasMany(Actor::class, 'group_id', 'id')->where('is_main', 1);
  }

  public function other_actors() {
    return $this->hasMany(Actor::class, 'group_id', 'id')->where('is_main', null);
  }

  public function children_groups() {
    return $this->hasMany(ActorGroup::class, 'parent_id', 'id');
  }

  public function parent_group() {
    return $this->belongsTo(ActorGroup::class, 'parent_id', 'id');
  }

}
