<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
          'address',
          'additional_address',
          'phone',
          'postcode',
          'city',
          'street',
          'facebook',
          'twitter',
          'instagram',
          'youtube',
          'map_coordinates_company',
          'email',
          'phone_cashbox',
          'phone_cashbox_tour',
          'current_season',
          'official_information_url',
        ];
        foreach($settings as $settingName) {
            factory(\App\Models\Setting::class, 'setting', 1)->create(['slug' => $settingName])->each(function($setting) use ($settingName) {
                $setting->translate('en')->save(factory(\App\Models\SettingTranslation::class, 'setting_en')->create(['setting_id' => $setting->id, 'title' => $settingName]));
                $setting->translate('ru')->save(factory(\App\Models\SettingTranslation::class, 'setting_ru')->create(['setting_id' => $setting->id, 'title' => $settingName]));
                $setting->translate('ua')->save(factory(\App\Models\SettingTranslation::class, 'setting_ua')->create(['setting_id' => $setting->id, 'title' => $settingName]));
            });
        }
    }
}
