<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Season::class, 'season', function (Faker $faker) {
  return [
    'number' => 2018,
  ];
});

$factory->defineAs(\App\Models\SeasonTranslation::class, 'season_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => 'Season' . $faker->sentence($nbWords = 1, $variableNbWords = true),
  ];
});

$factory->defineAs(\App\Models\SeasonTranslation::class, 'season_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Season title ru',
  ];
});

$factory->defineAs(\App\Models\SeasonTranslation::class, 'season_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Season title ua',
  ];
});
