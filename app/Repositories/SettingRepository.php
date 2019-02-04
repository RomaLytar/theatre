<?php
/**
 * Created by PhpStorm.
 * User: rise
 * Date: 5/21/2018
 * Time: 2:16 PM
 */

namespace App\Repositories;
use App\Models\Setting;
use App\Models\SettingTranslation;


class SettingRepository extends Repository
{
  /**
   * Specify Model class name
   *
   * @return mixed
   */
  function model()
  {
    return 'App\Models\Setting';
  }

  public function createSetting($data)
  {
    $setting = [
      'slug' => $data['slug'],
    ];
    $setting = $this->create($setting);
    $this->addTranslationSetting($data, $setting->id);
  }

  public function editSetting($data, $id)
  {
    $array = [];
    $this->update($array, ['id' => $id]);
    $setting = Setting::find($id);
    $this->editTranslationSetting($data, $setting);
  }

  public function addTranslationSetting($data, $settingId)
  {
    foreach (get_languages() as $lang => $val) {
      SettingTranslation::create([
        'setting_id' => $settingId,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }

  public function editTranslationSetting($data, $setting)
  {
    foreach (get_languages() as $lang => $val) {
      $settingTranslation = SettingTranslation::where(['setting_id' => $setting->id, 'language' => $lang])->first();
      $settingTranslation->update([
        'setting_id' => $setting->id,
        'language' => $lang,
        'title' => $data['title_' . $lang],
      ]);
    }
  }
}
