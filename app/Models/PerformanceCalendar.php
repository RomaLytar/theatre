<?php

namespace App\Models;

use App\Models\HallPricePattern;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Date\Date;

class PerformanceCalendar extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['performance_id', 'date', 'hall_price_pattern_id', 'isSoldInCashBox', 'isSoldOnline', 'areTicketsGenerated'];

    public function actors()
    {
        return $this->hasMany('App\Models\PerformanceActor', 'performance_calendar_id', 'id');
    }

    public function performance()
    {
        return $this->belongsTo('App\Models\Performance', 'performance_id');
    }

    public function getFormatDate() {
      return Date::parse($this->date)->format('j F Y');
    }

    public function getFormatTime() {
        return Date::parse($this->date)->format('H:i');
    }

    public function getFormatDateTime() {
        return $this->getFormatDate() . ' ' . $this->getFormatTime();
    }

    public function hallPricePattern() {
        return $this->belongsTo(HallPricePattern::class, 'hall_price_pattern_id');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class, 'performance_calendar_id');
    }

    public function selectedTickets($ticketIds) {
        return $this->tickets()->whereIn('id', $ticketIds);
    }

    public function availableTickets()
    {
        return $this->hasMany(Ticket::class, 'performance_calendar_id')->where('isAvailable', true);
    }

    public function shortTagline($сharacterNumber) {
        return str_limit($this->performance->translate->tagline, $сharacterNumber);
    }
}
