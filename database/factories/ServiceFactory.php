<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Service::class,'service', function (Faker $faker) {
    return [

    ];
});

$factory->defineAs(App\Models\ServiceTranslation::class, 'service_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 5, $variableNbWords = true),
    'description' => $faker->sentence($nbWords = 10, $variableNbWords = true),
  ];
});

$factory->defineAs(App\Models\ServiceTranslation::class, 'service_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => $faker->sentence($nbWords = 5, $variableNbWords = true),
    'description' => $faker->sentence($nbWords = 20, $variableNbWords = true),
  ];
});

$factory->defineAs(App\Models\ServiceTranslation::class, 'service_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => $faker->sentence($nbWords = 5, $variableNbWords = true),
    'description' => $faker->sentence($nbWords = 25, $variableNbWords = true),
  ];
});