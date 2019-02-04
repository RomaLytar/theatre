<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class ActorRole extends MultiLanguageModel implements HasMedia
{
  use HasMediaTrait;

  protected $multiLanguageForeignKey = 'actor_role_id';
  protected $multiLanguageLocalKey = 'id';

  public function multiLanguageModel()
  {
    return ActorRoleTranslation::class;
  }

  public function multiLanguageFields()
  {
    return ['title'];
  }
}
