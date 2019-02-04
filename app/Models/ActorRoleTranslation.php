<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActorRoleTranslation extends Model
{
  protected $fillable = ['actor_role_id', 'language', 'title'];
}
