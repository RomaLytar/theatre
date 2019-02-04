<?php

namespace App\Transformers;

use App\Models\Setting;
use League\Fractal\TransformerAbstract;

class SettingTransformer extends TransformerAbstract
{
    public function transform(Setting $setting)
    {
        return [
            'setting_name' => $setting->slug,
            'setting_title' => $setting->translate->title,
        ];
    }
}
