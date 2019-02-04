<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceActor extends Model
{
    protected $fillable = ['performance_calendar_id', 'actor_id', 'actor_role_id'];

    public function performance() {
      return $this->belongsToMany(Performance::class, 'performance_calendars', 'id', 'performance_id', 'performance_calendar_id');
    }

    public function date() {
      return $this->hasOne(PerformanceCalendar::class, 'id', 'performance_calendar_id');
    }

    public function actor() {
      return $this->belongsTo(Actor::class);
    }

    public function role() {
      return $this->belongsTo(ActorRole::class);
    }

    public function getFullnameAttribute() {
      return $this->actor->fullName;
    }
}
