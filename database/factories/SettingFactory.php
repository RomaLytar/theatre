<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Setting::class, 'setting', function (Faker $faker) {
  return [

  ];
});

$factory->defineAs(\App\Models\SettingTranslation::class, 'setting_en', function (Faker $faker) {
  return [
    'language' => 'en',
  ];
});

$factory->defineAs(\App\Models\SettingTranslation::class, 'setting_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
  ];
});

$factory->defineAs(\App\Models\SettingTranslation::class, 'setting_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
  ];
});
