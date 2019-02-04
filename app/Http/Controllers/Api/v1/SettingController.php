<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Setting;
use App\Transformers\SettingTransformer;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index() {
        $settings = Setting::with('translate')->get();

        return fractal()
            ->collection($settings)
            ->transformWith(new SettingTransformer)
            ->toArray();
    }
}
