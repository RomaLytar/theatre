<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class PerformanceType extends Model
{
    protected $fillable = ['name'];
    public function translate($language = null)
    {
        if (!$language) {
            $language = App::getLocale();
        }
        return $this->hasOne('App\Models\PerformanceTypeTranslation', 'performance_type_id', 'id')
          ->where('language', $language);
    }
}
