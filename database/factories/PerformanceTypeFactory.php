<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\PerformanceType::class, 'performance_type', function (Faker $faker) {
    return [

    ];
});

$factory->defineAs(\App\Models\PerformanceTypeTranslation::class, 'performance_type_en', function (Faker $faker) {
  return [
    'language' => 'en',
  ];
});

$factory->defineAs(\App\Models\PerformanceTypeTranslation::class, 'performance_type_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
  ];
});

$factory->defineAs(\App\Models\PerformanceTypeTranslation::class, 'performance_type_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
  ];
});
