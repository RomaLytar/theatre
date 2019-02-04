<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SettingProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $settings = Setting::all();

        // foreach ($settings as $setting) {
        //   $_SESSION['en'][$setting->slug] = $setting->translate('en')->first()->setting;
        //   $_SESSION['ru'][$setting->slug] = $setting->translate('ru')->first()->setting;
        //   $_SESSION['ua'][$setting->slug] = $setting->translate('ua')->first()->setting;
        // }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
