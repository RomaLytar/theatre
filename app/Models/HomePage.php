<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    const RECOMMENDED_TYPE = 'recommended';
    const SPECIAL_PROJECTS_TYPE = 'specialProjects';
    const PROMO_SLIDER_TYPE = 'promoSlider';
    const PROMO_SLIDER_MINI_TYPE = 'promoSliderMini';

    protected $fillable = ['type', 'performance_calendar_id'];
    protected $table = 'home_page_components';

    public function performanceDate()
    {
      return $this->belongsTo('App\Models\PerformanceCalendar', 'performance_calendar_id');
    }
}
